<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\Entity\Utilisateur;
use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Form\RegistrationTypeClient;
use App\Form\RegistrationTypeEntreprise;
class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function SignIn(Request $request, UserPasswordEncoderInterface $encoder)
    {   
        if($this->getUser() == null){
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
            $formClient = $this->createForm(RegistrationTypeClient::class,$Utilisateur);
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

                 return $this->redirectToRoute('home');
            }
            if ($formAdresse->isSubmitted() && $formAdresse->isValid()) { 
                $Adresse->setUtilisateur($Utilisateur);
                $em->persist($Adresse);
                $em->flush();

                return $this->redirectToRoute('home');
            }


            return $this->render('security/signin.html.twig', [
                'formClient' => $formClient->createView(),
                'formEntreprise' =>$formEntreprise->createView(),                       
                'formAdresse' => $formAdresse->createView(),
                'typeCompte' => $typeCompte->createView(), 
                'controller_name' => 'SecurityController',
            ]);
        }
        else{
            $this->addFlash('error', 'Vous êtes déja connecté !');
            return $this->redirectToRoute('home');
        }
    }
    /**
     * @Route("/connexion/mot-de-passe-oublie", name="security_forgot")
     */
    public function passwordForget(Request $request, UserPasswordEncoderInterface $encoder,
                                     \Swift_Mailer $mailer,
                                    TokenGeneratorInterface $tokenGenerator)
    {
         if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(Utilisateur::class)->findOneByEmail($email);

            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('home');
            }
            $token = $tokenGenerator->generateToken();

            try{
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
                    "Cliquez ici pour réinitialiser votre mot de passe : " . $url,
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('notice', 'Un mail vient de vous être envoyé pour la réinitialisation. ');

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

            $this->addFlash('sucess', 'Votre mot de passe a bien été mis à jour, veuillez vous connecter.');

            return $this->redirectToRoute('home');
        }else {

            return $this->render('security/resetPassword.html.twig', ['token' => $token]);
        }
    }

    /**
     * @Route("/deconnexion/", name="security_logout")
     */
    public function logout(){

    }

    /**
     * @Route("/connexion/", name="security_login")
     */
    public function login(){

        if($this->getUser() == null){
            return $this->render('security/login.html.twig', [
                'controller_name' => 'SecurityController',
            ]);
        }
        else{
            $this->addFlash('error', 'Vous êtes déja connecté !');
            return $this->redirectToRoute('home');
        }
    }
}
