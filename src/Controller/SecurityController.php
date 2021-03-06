<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Utilisateur;
use App\Form\AdresseType;
use App\Form\RegistrationTypeClient;
use App\Form\RegistrationTypeEntreprise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function SignIn(Request $request, UserPasswordEncoderInterface $encoder)
    {
        if ($this->getUser() == null) { // Si l'utilisateur n'est pas connecté
            $Utilisateur = new Utilisateur();
            $Adresse = new Adresse();

            $typeCompte = $this->createFormBuilder($Utilisateur)
                ->add('utilisateurType', ChoiceType::class, array(
                    'label' => false,
                    'placeholder' => 'Type de compte',
                    'choices' => array(
                        'Particulier' => 'client',
                        'Professionnel' => 'pro',
                    ),
                    'required' => true
                ))
                ->getForm();
            $formClient = $this->createForm(RegistrationTypeClient::class, $Utilisateur);
            $formEntreprise = $this->createForm(RegistrationTypeEntreprise::class, $Utilisateur);
            $formAdresse = $this->createForm(AdresseType::class, $Adresse);

            $formClient->handleRequest($request);
            $formEntreprise->handleRequest($request);
            $formAdresse->handleRequest($request);

            $em = $this->getDoctrine()->getManager();

            if ($formClient->isSubmitted() && $formClient->isValid()) {
                $hash = $encoder->encodePassword($Utilisateur, $Utilisateur->getPassword());
                $Utilisateur->setPassword($hash);
                $Utilisateur->setUtilisateurType("client");
                $em->persist($Utilisateur);
                $em->flush();
            }

            if ($formEntreprise->isSubmitted() && $formEntreprise->isValid()) {
                $hash = $encoder->encodePassword($Utilisateur, $Utilisateur->getPassword());
                $Utilisateur->setPassword($hash);
                $Utilisateur->setUtilisateurType("pro");
                $em->persist($Utilisateur);
                $em->flush();

                $this->addFlash('success', 'Votre compte a bien été créé !');
                return $this->redirectToRoute('home');
            }
            if ($formAdresse->isSubmitted() && $formAdresse->isValid()) {
                $Adresse->setUtilisateur($Utilisateur);
                $em->persist($Adresse);
                $em->flush();

                $this->addFlash('success', 'Votre compte a bien été créé !');
                return $this->redirectToRoute('home');
            }


            return $this->render('security/signin.html.twig', [
                'formClient' => $formClient->createView(),
                'formEntreprise' => $formEntreprise->createView(),
                'formAdresse' => $formAdresse->createView(),
                'typeCompte' => $typeCompte->createView(),
                'controller_name' => 'SecurityController',
            ]);
        } else { // Sinon on lui refuse l'accès
            $this->addFlash('error', 'Vous êtes déja connecté !');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/connexion/mot-de-passe-oublie", name="security_forgot")
     */
    public function passwordForget(Request $request, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator)
    {
        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(Utilisateur::class)->findOneByEmail($email);

            if ($user === null) {
                $this->addFlash('danger', 'Cette adresse email est inconnue.');
                return $this->redirectToRoute('home');
            }
            $token = $tokenGenerator->generateToken();

            try {
                $user->setTokenPassword($token);
                $em->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('home');
            }

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Mot de passe oublié'))
                ->setTo($user->getEmail())
                ->setFrom('contact@kangas.fr')
                ->setBody(
                    "Bonjour,<br/>
                            <br/>
                            Cliquez ici pour réinitialiser votre mot de passe : <a href=\"".$url."\" target='_blank'>$url</a>.<br/>
                            <br/>
                            Bien cordialement,<br/>
                            L'équipe Eco-Service",
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('notice', 'Un mail vient de vous être envoyé pour la réinitialisation.');

            return $this->redirectToRoute('home');
        }

        return $this->render('security/passwordforget.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/reinitialiser-mot-de-passe/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository(Utilisateur::class)->findOneByTokenPassword($token);

            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('home');
            }

            $user->setTokenPassword(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $em->flush();

            $this->addFlash('success', 'Votre mot de passe a bien été mis à jour, veuillez vous connecter.');

            return $this->redirectToRoute('home');
        } else {

            return $this->render('security/resetPassword.html.twig', ['token' => $token]);
        }
    }

    /**
     * @Route("/deconnexion/", name="security_logout")
     */
    public function logout()
    {
        $this->addFlash('success', 'Vous avez été déconnecté.');
    }

    /**
     * @Route("/connexion/", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        if ($this->getUser() == null) { // Si l'utilisateur n'est pas connecté
            if ($error)
                $this->addFlash('error', 'Mot de passe ou adresse e-mail invalide.');

            return $this->render('security/login.html.twig', [
                'controller_name' => 'SecurityController',
                'error' => $error,
            ]);
        } else { // Sinon l'accès lui est refusé
            $this->addFlash('error', 'Vous êtes déja connecté.');
            return $this->redirectToRoute('home');
        }
    }
}
