<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Commande;
use App\Entity\Role;
use App\Entity\Utilisateur;
use App\Form\RegistrationTypeClient;
use App\Form\RegistrationTypeEntreprise;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{

    ////////////////////CLIENT////////////////////////////////

    /**
     * @Route("/profil/client", name="profil_client")
     */
    public function profilClient()
    {
        if ($this->getUser() != null) { // Si l'utilisateur est identifié
            $UtilisateurId = $this->getUser()->getId();

            //Aiguillage particulier/entreprise
            if ($this->getUser()->getUtilisateurType() != "pro") { // Si l'utilisateur n'est pas un pro on affiche le profil
                $userDetails = $this->getDoctrine()
                    ->getRepository(Utilisateur::class)
                    ->getUtilisateurClientById($UtilisateurId);
                $Adresse = $this->getDoctrine()
                    ->getRepository(Adresse::class)
                    ->getAdresseById($UtilisateurId);

                $commandes = $this->getDoctrine()
                    ->getRepository(Commande::class)
                    ->findByUserId($this->getUser()->getId());

                $form = $this->createForm(RegistrationTypeClient::class, $userDetails);

                return $this->render('user/profilClient.html.twig', [
                    'form' => $form->createView(),
                    'Adresse' => $Adresse,
                    'commandes' => $commandes,
                    'controller_name' => 'UserController',
                ]);
            } else { // Si c'est une entreprise, on redirige le client vers le profil entreprise
                return $this->redirectToRoute('profil_entreprise');
            }
        } else { // Si l'utilisateur n'est pas identifié on lui demande de se connecter
            $this->addFlash('error', 'Vous n\'êtes pas connecté. Veuillez vous inscrire.');
            return $this->redirectToRoute('security_login');
        }
    }

    /**
     * @Route("/profil/client/edit", name="client_edit")
     */
    public function ClientEdit(Request $request, UserPasswordEncoderInterface $encoder)
    {
        if ($this->getUser() != null) { // Si l'utilisateur est identifié
            $UtilisateurId = $this->getUser()->getId();

            //Aiguillage particulier/entreprise
            if ($this->getUser()->getUtilisateurType() != "pro") { // Si l'utilisateur n'est pas un pro on affiche le profil
                $userDetails = $this->getDoctrine()
                    ->getRepository(Utilisateur::class)
                    ->getUtilisateurClientById($UtilisateurId);
                $Adresse = $this->getDoctrine()
                    ->getRepository(Adresse::class)
                    ->getAdresseById($UtilisateurId);

                $form = $this->createForm(RegistrationTypeClient::class, $userDetails);
                $form->handleRequest($request);


                if ($form->isSubmitted() && $form->isValid()) {
                    $Utilisateur = $this->getUser();
                    $data = $form->getData();
                    $hash = $encoder->encodePassword($Utilisateur, $Utilisateur->getPassword());
                    $Utilisateur->setPassword($hash);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($data);
                    $em->flush();
                    $this->addFlash('success', 'Vos données ont été modifiées !');

                    return $this->redirectToRoute('profil_client');
                }

                return $this->render('user/ClientEdit.html.twig', [
                    'form' => $form->createView(),
                    'Adresse' => $Adresse,
                    'controller_name' => 'UserController',
                ]);
            } else { // Si c'est une entreprise, on redirige le client vers le profil entreprise
                return $this->redirectToRoute('profil_entreprise');
            }
        } else { // Si l'utilisateur n'est pas identifié on lui demande de se connecter
            $this->addFlash('error', 'Vous n\'êtes pas connecté. Veuillez vous inscrire.');
            return $this->redirectToRoute('security_login');
        }
    }



    ////////////////////ENTREPRISE////////////////////////////////

    /**
     * @Route("/profil/entreprise", name="profil_entreprise")
     */
    public function profilEnteprise()
    {
        if ($this->getUser() != null) { // Si l'utilisateur est identifié

            //Aiguillage particulier/entreprise
            if ($this->getUser()->getUtilisateurType() == "pro") { // Si l'utilisateur a un compte pro on affiche le profil

                $UtilisateurId = $this->getUser()->getId();
                $userDetails = $this->getDoctrine()
                    ->getRepository(Utilisateur::class)
                    ->getUtilisateurProById($UtilisateurId);

                $form = $this->createForm(RegistrationTypeEntreprise::class, $userDetails);

                return $this->render('user/profilEntreprise.html.twig', [
                    'form' => $form->createView(),
                    'controller_name' => 'UserController',
                ]);
            } else { // Si l'utilisateur n'a pas un compte pro on redirige vers le profil client
                return $this->redirectToRoute('profil_client');
            }
        } else { // Si l'utilisateur n'est pas identifié on lui demande de se connecter
            $this->addFlash('error', 'Vous n\'êtes pas connecté. Veuillez vous inscrire.');
            return $this->redirectToRoute('security_login');
        }
    }

    /**
     * @Route("/profil/entreprise/edit", name="entreprise_edit")
     */
    public function EntrepriseEdit(Request $request, UserPasswordEncoderInterface $encoder)
    {
        if ($this->getUser() != null) { // Si l'utilisateur est identifié
            $UtilisateurId = $this->getUser()->getId();

            //Aiguillage particulier/entreprise
            if ($this->getUser()->getUtilisateurType() == "pro") { // Si l'utilisateur a un compte pro on affiche le profil
                $userDetails = $this->getDoctrine()
                    ->getRepository(Utilisateur::class)
                    ->getUtilisateurProById($UtilisateurId);

                $form = $this->createForm(RegistrationTypeEntreprise::class, $userDetails);
                $form->handleRequest($request);


                if ($form->isSubmitted() && $form->isValid()) {
                    $Utilisateur = $this->getUser();
                    $data = $form->getData();
                    $hash = $encoder->encodePassword($Utilisateur, $Utilisateur->getPassword());
                    $Utilisateur->setPassword($hash);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($data);
                    $em->flush();
                    $this->addFlash('success', 'Vos données ont été modifiées !');

                    return $this->redirectToRoute('profil_entreprise');
                }

                return $this->render('user/EntrepriseEdit.html.twig', [
                    'form' => $form->createView(),
                    'controller_name' => 'UserController',
                ]);
            } else { // Si l'utilisateur n'a pas un compte pro on redirige vers le profil client
                return $this->redirectToRoute('profil_entreprise');
            }
        } else { // Si l'utilisateur n'est pas identifié on lui demande de se connecter
            $this->addFlash('error', 'Vous n\'êtes pas connecté. Veuillez vous inscrire.');
            return $this->redirectToRoute('security_login');
        }
    }

    /**
     * @Route("/profil/commande/{id}", name="show_command")
     */
    public function ShowCommande(CommandeRepository $repo, $id)
    {
        if ($this->getUser() != null) { // Si l'utilisateur est identifié
            $commande = $repo->find($id);

            return $this->render('achat/showCommande.html.twig', [
                'controller_name' => 'AchatController',
                'commande' => $commande,
                'adresse' => explode('|', $commande->getShippingAddr()),
            ]);
        } else { // Sinon l'accès lui est refusé
            $this->addFlash('error', 'Veuillez vous connecter. Accès refusé.');
            return $this->redirectToRoute('security_login');
        }
    }

    ////////////////////ADMINISTRATION////////////////////////////////

    /**
     * @Route("/admin/user", name="afficher_admin"))
     */
    public function showAdminBlog()
    {
        if ($this->getUser() != null && $this->getUser()->getUtilisateurType() == "admin") { // Si l'utilisateur est connecté en tant qu'admin
            $repo = $this->getDoctrine()->getRepository(Utilisateur::class);
            $utilisateurs = $repo->getAllUserAdministration();

            return $this->render('user/afficherAdmin.html.twig', [
                'controller_name' => 'UserController',
                'utilisateurs' => $utilisateurs,
            ]);
        } else {
            $this->addFlash('error', 'Veuillez vous connecter en tant qu\'administrateur. Accès refusé.');
            return $this->redirectToRoute('security_login');
        }
    }

    /**
     * @Route("/admin/user/add_admin", name="add_user_admin")
     * @Route("/admin/user/{id}/edit", name="edit_user_admin")
     */
    public function ajouterUtilisateur(Utilisateur $utilisateur = null, Request $request, EntityManagerInterface $manager)
    {
        if ($this->getUser() != null && $this->getUser()->getUtilisateurType() == "admin") { // Si l'utilisateur est connecté en tant qu'admin

            if (!$utilisateur) {
                $utilisateur = new Utilisateur();
            }

            $form = $this->createFormBuilder($utilisateur)
                ->add('UtilisateurType', ChoiceType::class, array(
                    'label' => false,
                    'choices' => array(
                        'Administrateur' => 'admin',
                        'Modérateur' => 'modo',
                        'Particulier' => 'client',
                        'Professionnel' => 'pro',
                    ),
                    'required' => true
                ))
                ->add('email', EmailType::class)
                ->add('civilite', ChoiceType::class, array(
                    'label' => false,
                    'placeholder' => 'Civilité',
                    'choices' => array(
                        'Mr' => 'mr',
                        'Mme' => 'mme',
                        'Autre' => 'autre'
                    ),
                    'required' => true
                ))
                ->add('password', PasswordType::class)
                ->add('nom', TextType::class)
                ->add('prenom', TextType::class)
                ->add('telephone', TelType::class)
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $manager->persist($utilisateur);
                $manager->flush();

                return $this->redirectToRoute('afficher_admin');
            }

            return $this->render('user/ajouterAdmin.html.twig', [
                'controller_name' => 'UserController',
                'formAdmin' => $form->createView(),
                'editMode' => $utilisateur !== null,
            ]);
        } else {
            $this->addFlash('error', 'Veuillez vous connecter en tant qu\'administrateur. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/admin/user/{id}/delete", name="delete_user_admin"))
     */
    public function deleteAdmin(Utilisateur $utilisateur, EntityManagerInterface $manager)
    {
        if ($this->getUser() != null && $this->getUser()->getUtilisateurType() == "admin") { // Si l'utilisateur est connecté en tant qu'admin

            $manager->remove($utilisateur);
            $manager->flush();

            return $this->redirectToRoute('afficher_admin');
        } else {
            $this->addFlash('error', 'Veuillez vous connecter en tant qu\'administrateur. Accès refusé.');
            return $this->redirectToRoute('security_login');
        }
    }
}
