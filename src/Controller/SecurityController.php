<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Utilisateur;
use App\Form\RegistrationType;
class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="security_login")
     */
    public function loginSignIn(Request $request)
    {   
        $Utilisateur = new Utilisateur;
        
        $form = $this->createForm(RegistrationType::class, $Utilisateur);

        // $form->handleRequest($request);
        // $entityManager = $this->getDoctrine()->getManager();

        // if ($form->isSubmitted() && $form->isValid()) { 
        //     $entityManager->persist($Utilisateur);
        //     $Utilisateur->setUtilisateurType("client");
        // }

        // $entityManager->flush();

        return $this->render('security/loginsignin.html.twig', [
            'form' => $form->createView(),
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
