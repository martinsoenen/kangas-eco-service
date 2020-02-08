<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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
        }
        if ($formAdresse->isSubmitted() && $formAdresse->isValid()) { 
            dump($Utilisateur);
            $Adresse->setUtilisateur($Utilisateur);
            $em->persist($Adresse);
            $em->flush();
        }

         $Adresse->setUtilisateur($Utilisateur);

        return $this->render('security/signin.html.twig', [
            'formClient' => $formClient->createView(),
            'formEntreprise' =>$formEntreprise->createView(),                       
            'formAdresse' => $formAdresse->createView(),
            'typeCompte' => $typeCompte->createView(), 
            'controller_name' => 'SecurityController',
        ]);
    }
    /**
     * @Route("/connexion/mot-de-passe-oublie", name="security_forgot")
     */
    public function passwordForget()
    {
        return $this->render('security/passwordforget.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
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
        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }
}
