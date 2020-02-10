<?php

namespace App\Controller;

use App\Service\Panier\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AchatController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(PanierService $panierService)
    {
        return $this->render('achat/index.html.twig', [
            'controller_name' => 'AchatController',
            'items' => $panierService->getPanierComplet(),
            'total' => $panierService->getTotal()
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

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add($id, PanierService $panierService)
    {
        $panierService->add($id);

        return $this->redirectToRoute("panier");
    }

    /**
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function remove($id, PanierService $panierService)
    {
        $panierService->remove($id);

        return $this->redirectToRoute("panier");

    }
}
