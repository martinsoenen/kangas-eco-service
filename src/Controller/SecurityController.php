<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


use App\Entity\Utilisateur;
use App\Form\RegistrationTypeClient;
use App\Form\RegistrationTypeEntreprise;
class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="security_login")
     */
    public function loginSignIn(Request $request, UserPasswordEncoderInterface $encoder)
    {   
        $Utilisateur = new Utilisateur;
        
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
        $formClient->handleRequest($request);
        $formEntreprise->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        
        if ($formClient->isSubmitted() && $formClient->isValid()) { 
            $hash = $encoder->encodePassword($Utilisateur, $Utilisateur->getPassword());    
            $Utilisateur->setPassword($hash);

            $em->persist($Utilisateur);
            $em->flush();
        }

        return $this->render('security/loginsignin.html.twig', [
            'formClient' => $formClient->createView(),
            'formEntreprise' =>$formEntreprise->createView(),
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
    
}
