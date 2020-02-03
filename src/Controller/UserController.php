<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}
