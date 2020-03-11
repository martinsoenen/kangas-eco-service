<?php

namespace App\Controller;

use App\Entity\Role;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\Utilisateur;
use App\Entity\Adresse;
use App\Form\RegistrationTypeClient;
use App\Form\RegistrationTypeEntreprise;
use App\Form\AdresseType;
use Symfony\Component\Security\Core\User\User;


class UserController extends AbstractController
{

        ////////////////////CLIENT////////////////////////////////

     /**
     * @Route("/profil/client", name="profil_client")
     */
    public function profilClient()
    {   
        if($this->getUser() != null){
            $UtilisateurId = $this->getUser()->getId();

            //Aiguillage particulier/entreprise
            if($this->getUser()->getUtilisateurType()=="client" || $this->getUser()->getUtilisateurType()=="admin" ){
                $userDetails = $this->getDoctrine()
                                    ->getRepository(Utilisateur::class)
                                    ->getUtilisateurClientById($UtilisateurId);
                $Adresse =$this->getDoctrine()
                                    ->getRepository(Adresse::class)
                                    ->getAdresseById($UtilisateurId);

                $form = $this->createForm(RegistrationTypeClient::class, $userDetails);

                
                return $this->render('user/profilClient.html.twig', [
                    'form' => $form->createView(),
                    'Adresse' => $Adresse,
                    'controller_name' => 'UserController',
                ]);
            }
            else {
                 return $this->redirectToRoute('profil_entreprise');
            }
        }
        else {
            return $this->redirectToRoute('security_login');
        }
    }

    /**
     * @Route("/profil/client/edit", name="client_edit")
     */
    public function ClientEdit(Request $request, UserPasswordEncoderInterface $encoder)
    {   
        if($this->getUser() != null){
            $UtilisateurId = $this->getUser()->getId();

            //Aiguillage particulier/entreprise
            if($this->getUser()->getUtilisateurType()=="client" || $this->getUser()->getUtilisateurType()=="admin") {
                $userDetails = $this->getDoctrine()
                                    ->getRepository(Utilisateur::class)
                                    ->getUtilisateurClientById($UtilisateurId);
                $Adresse =$this->getDoctrine()
                                    ->getRepository(Adresse::class)
                                    ->getAdresseById($UtilisateurId);

                $form = $this->createForm(RegistrationTypeClient::class, $userDetails);
                $form->handleRequest($request);


                if ($form->isSubmitted() && $form->isValid()) {
                    $Utilisateur= $this->getUser();
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
            }
            else {
                 return $this->redirectToRoute('profil_entreprise');
            }
        }
        else {
            return $this->redirectToRoute('security_login');
        }
    }



    ////////////////////ENTREPRISE////////////////////////////////

     /**
     * @Route("/profil/entreprise", name="profil_entreprise")
     */
    public function profilEnteprise()
    {
        if($this->getUser() != null){
            
            //Aiguillage particulier/entreprise
            if($this->getUser()->getUtilisateurType()=="pro"){

                $UtilisateurId = $this->getUser()->getId();
                $userDetails = $this->getDoctrine()
                                    ->getRepository(Utilisateur::class)
                                    ->getUtilisateurProById($UtilisateurId);

                $form = $this->createForm(RegistrationTypeEntreprise::class, $userDetails);
                                    
                return $this->render('user/profilEntreprise.html.twig', [
                    'form' => $form->createView(),
                    'controller_name' => 'UserController',
                ]);
            }
            else {
                return $this->redirectToRoute('profil_client');
            }
        }
        else {
            return $this->redirectToRoute('security_login');
        }
    }

    /**
     * @Route("/profil/entreprise/edit", name="entreprise_edit")
     */
    public function EntrepriseEdit(Request $request, UserPasswordEncoderInterface $encoder)
    {   
        if($this->getUser() != null){
            $UtilisateurId = $this->getUser()->getId();

            //Aiguillage particulier/entreprise
            if($this->getUser()->getUtilisateurType()=="pro"){
                $userDetails = $this->getDoctrine()
                                    ->getRepository(Utilisateur::class)
                                    ->getUtilisateurProById($UtilisateurId);

                $form = $this->createForm(RegistrationTypeEntreprise::class, $userDetails);
                $form->handleRequest($request);


                if ($form->isSubmitted() && $form->isValid()) {
                    $Utilisateur= $this->getUser();
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
            }
            else {
                 return $this->redirectToRoute('profil_entreprise');
            }
        }
        else {
            return $this->redirectToRoute('security_login');
        }
    }

    ////////////////////ADMINISTRASTION////////////////////////////////

    /**
     * @Route("/admin/user", name="afficher_admin"))
     */
    public function showAdminBlog()
    {
        $repo = $this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateurs = $repo->findAll();

        return $this->render('user/afficherAdmin.html.twig', [
            'controller_name' => 'UserController',
            'utilisateurs' => $utilisateurs,
        ]);

    }

    /**
     * @Route("/admin/user/addAdmin", name="add_user_admin")
     * @Route("/admin/user/{id}/edit", name="edit_user_admin")
     */
    public function ajouterUtilisateur(Utilisateur $utilisateur = null,Request $request,EntityManagerInterface $manager){

        if(!$utilisateur){
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
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('telephone', TelType::class )
            ->getForm();


        $form->handleRequest($request);


        if($form->isSubmitted()&& $form->isValid()) {

            $manager->persist($utilisateur);
            $manager->flush();

            return $this->redirectToRoute('afficher_admin');
        }

        return $this->render('user/ajouterAdmin.html.twig', [
            'controller_name' => 'UserController',
            'formAdmin'=> $form->createView(),
            'editMode'=>$utilisateur!== null,
        ]);
    }

    /**
     * @Route("/admin/user/{id}/delete", name="delete_user_admin"))
     */
    public function deleteAdmin(Utilisateur $utilisateur,EntityManagerInterface $manager){
        $manager->remove($utilisateur);
        $manager->flush();

        return $this->redirectToRoute('afficher_admin');
    }
}
