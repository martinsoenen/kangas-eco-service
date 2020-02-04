<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="security_login")
     */
    public function loginSignIn()
    {
        return $this->render('security/loginsignin.html.twig', [
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
