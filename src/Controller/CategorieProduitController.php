<?php

namespace App\Controller;

use App\Entity\CategorieProduit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategorieProduitController extends AbstractController
{
    /**
     * @Route("/admin/produits/categorie", name="admin_categorie_produits")
     */
    public function afficherCategorieProduit()
    {
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin") {
            $repo = $this->getDoctrine()->getRepository(CategorieProduit::class);
            $categories = $repo->findAll();
            return $this->render('product/afficherCategorieProduit.html.twig', [
                'controller_name' => 'CategorieProduitController',
                'categories' => $categories
            ]);
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/admin/produit/categorie/add", name="ajouter_categorie_produit")
     * @Route("/admin/produit/categorie/{id}/edit", name="modifier_categorie_produit")
     */
    public function ajouterCategorieProduit(CategorieProduit $categorieProduit = null,Request $request,EntityManagerInterface $manager)
    {
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){
            $editmode = true;
            if(!$categorieProduit) {
                $categorieProduit = new CategorieProduit();
                $editmode = false;
            }
            $form = $this->createFormBuilder($categorieProduit)
                ->add('nom',TextType::class,array('required'  => true))
                // ->add('UtilisateurAdmin',EntityType::class,[
                //     'class' => UtilisateurAdministration::class,
                //     'choice_label' => 'Nom',
                //     'required'  => true,
                // ])
                ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted()&& $form->isValid()) {

                $manager->persist($categorieProduit);
                $manager->flush();
                return $this->redirectToRoute('admin_categorie_produits');
            }

            return $this->render('product/ajouterCategorieProduit.html.twig', [
                'controller_name' => 'CategorieProduitController',
                'formCategorieProduit'=> $form->createView(),
                'editMode'=>$editmode,
            ]);
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }

    /**
     *  @Route("/admin/produit/categorie/{id}/delete", name="delete_categorie_produit")
     */
    public function deleteCategorieProduit(CategorieProduit $categorieProduit, EntityManagerInterface $manager){
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){
            $repo = $this->getDoctrine()->getRepository(CategorieProduit::class);
            $produit = $repo->findProduitsBySousCategorie($categorieProduit->getId());
            if($produit != null) {
                $manager->remove($categorieProduit);
                $manager->flush();
            }else{
                $this->addFlash('error', 'Il y a un ou plusieurs produits pour cette catégorie, veuillez modifier le(s) produit(s)');
            }
            return $this->redirectToRoute('admin-categorie-produits');
        }
        else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }
}
