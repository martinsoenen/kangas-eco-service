<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/magasin", name="magasin")
     */
    public function index()
    {
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/magasin/produit_{id}", name="magasin-produit")
     */
    public function show()
    {
        return $this->render('product/show.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/admin/produits", name="admin-produits")
     */
    public function admin_show()
    {
        return $this->render('product/admin_show.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}
