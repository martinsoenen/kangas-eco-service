<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/magasin", name="magasin")
     */
    public function index()
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
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
