<?php

namespace App\Controller;

use App\Entity\CategorieProduit;
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
        $categories = $this->getDoctrine()->getRepository(CategorieProduit::class)->findCategories();

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'produits' => $produits,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/magasin/categorie/{id}", name="categorie-produit")
     */
    public function categorie()
    {
        return $this->render('product/showByCategorie.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/magasin/sous-categorie/{id}", name="sous-categorie-produit")
     */
    public function sous_categorie()
    {
        return $this->render('product/showBySousCategorie.html.twig', [
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
