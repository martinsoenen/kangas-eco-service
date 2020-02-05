<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AchatController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index()
    {
        return $this->render('achat/index.html.twig', [
            'controller_name' => 'AchatController',
        ]);
    }

    /**
     * @Route("/panier/paiement", name="panier_paiement")
     */
    public function paiement()
    {
        return $this->render('achat/paiement.html.twig', [
            'controller_name' => 'AchatController',
        ]);
    }
}
