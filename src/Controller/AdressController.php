<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdressController extends AbstractController
{
    /**
     * @Route("/profil/adresse", name="profil_adresse")
     */
    public function index()
    {
        return $this->render('adress/index.html.twig', [
            'controller_name' => 'AdressController',
        ]);
    }
}
