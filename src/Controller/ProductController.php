<?php

namespace App\Controller;

use App\Entity\CategorieProduit;
use App\Entity\Produit;
use App\Entity\SousCategorieProduit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

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
     * @Entity("CategorieProduit", expr="repository.find(id)")
     */
    public function categorie(CategorieProduit $categorie)
    {
        $id = $categorie->getId();
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findProduitsByCategorie($id);

        return $this->render('product/showByCategorie.html.twig', [
            'controller_name' => 'ProductController',
            'categorie' => $categorie,
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/magasin/sous-categorie/{id}", name="sous-categorie-produit")
     * @Entity("SousCategorieProduit", expr="repository.find(id)")
     */
    public function sous_categorie(SousCategorieProduit $souscategorie)
    {
        $id = $souscategorie->getId();
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findProduitsBySousCategorie($id);

        return $this->render('product/showBySousCategorie.html.twig', [
            'controller_name' => 'ProductController',
            'souscategorie' => $souscategorie,
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
