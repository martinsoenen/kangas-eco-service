<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\UtilisateurAdministration;

use App\Repository\UtilisateurAdministrationRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
     /**
     * @Route("/profil/client", name="profil_client")
     */
    public function profilClient()
    {   
        
        return $this->render('user/profilClient.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

     /**
     * @Route("/profil/entreprise", name="profil_entreprise")
     */
    public function profilEnteprise()
    {
        return $this->render('user/profilEntreprise.html.twig', [
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

            return $this->redirectToRoute('afficher_admin');
        }



        return $this->render('user/ajouterAdmin.html.twig', [
            'controller_name' => 'UserController',
            'formAdmin'=> $form->createView(),
            'editMode'=>$admin->getId() !== null,
        ]);
    }

    /**
     * @Route("/admin/afficher-admin", name="afficher_admin")
     */
    public function afficherUserAdministration()
    {
        $repo = $this->getDoctrine()->getRepository(UtilisateurAdministration::class);
        $admins = $repo->findAll();


        return $this->render('user/afficherAdmin.html.twig', [
            'controller_name' => 'UserController',
            'admins' => $admins,
        ]);
    }

    /**
     *  @Route("/admin/{id}/delete", name="delete_admin")
     */
    public function deleteUserAdministration(UtilisateurAdministration $admin, EntityManagerInterface $manager){
        $manager->remove($admin);
        $manager->flush();

        return $this->redirectToRoute('afficher_admin');
    }
}
