<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\UtilisateurAdministration;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


use App\Entity\Utilisateur;

class UserController extends AbstractController
{
     /**
     * @Route("/profil/client", name="profil_client")
     */
    public function profilClient()
    {   
        
        $UtilisateurId = $this->getUser()->getId();
        $userDetails = $this->getDoctrine()
                             ->getRepository(Utilisateur::class)
                             ->getUtilisateurClientById($UtilisateurId);

        return $this->render('user/profilClient.html.twig', [
            'usersDetails' => $userDetails,
            'controller_name' => 'UserController',
        ]);
    }

     /**
     * @Route("/profil/entreprise", name="profil_entreprise")
     */
    public function profilEnteprise()
    {
        
        $UtilisateurId = $this->getUser()->getId();
        $userDetails = $this->getDoctrine()
                             ->getRepository(Utilisateur::class)
                             ->getUtilisateurProById($UtilisateurId);
                             
        return $this->render('user/profilEntreprise.html.twig', [
            'usersDetails' => $userDetails,
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/admin/ajouter-admin", name="ajouter_admin")
     * @Route("/admin/{id}/edit", name="modifier_admin")
     */
    public function ajouterUserAdministration(UtilisateurAdministration $admin = null,Request $request,EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        if(!$admin) {
            $admin = new UtilisateurAdministration();
        }
        $form = $this->createFormBuilder($admin)
            ->add('Role',EntityType::class,[
                'class' => Role::class,
                'choice_label' => 'Nom',
                'required'  => true,
            ])
            ->add('Nom', TextType::class,array('required'  => true))
            ->add('Prenom', TextType::class,array('required'  => true))
            ->add('Email', TextType::class,array('required'  => true))
            ->add('Password', PasswordType::class)
            ->getForm();


        $form->handleRequest($request);


        if($form->isSubmitted()&& $form->isValid()) {
            $hash = $encoder->encodePassword($admin, $admin->getPassword());
            $admin->setPassword($hash);

            $manager->persist($admin);
            $manager->flush();

            return $this->redirectToRoute('ajouter_admin');
        }



        return $this->render('user/ajouterAdmin.html.twig', [
            'controller_name' => 'UserController',
            'formAdmin'=> $form->createView(),
            'editMode'=>$admin->getId() !== null,
        ]);
    }
}
