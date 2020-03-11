<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\CategorieProduit;
use App\Entity\Produit;
use App\Entity\SousCategorieProduit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\File;

class CategorieProduitController extends AbstractController
{
    /**
     * @Route("/admin/produits/categorie", name="admin_categorie_produits")
     */
    public function afficherCategorieProduit()
    {
        $repo = $this->getDoctrine()->getRepository(CategorieProduit::class);
        $categories = $repo->findAll();
        return $this->render('product/afficherCategorieProduit.html.twig', [
            'controller_name' => 'CategorieProduitController',
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/admin/produit/categorie/add", name="ajouter_categorie_produit")
     * @Route("/admin/produit/categorie/{id}/edit", name="modifier_categorie_produit")
     */
    public function ajouterCategorieProduit(CategorieProduit $categorieProduit = null,Request $request,EntityManagerInterface $manager)
    {
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
            return $this->redirectToRoute('admin-categorie-produits');
        }

        return $this->render('product/ajouterCategorieProduit.html.twig', [
            'controller_name' => 'CategorieProduitController',
            'formCategorieProduit'=> $form->createView(),
            'editMode'=>$editmode,
        ]);
    }

    /**
     *  @Route("/admin/produit/categorie/{id}/delete", name="delete_categorie_produit")
     */
    public function deleteCategorieProduit(CategorieProduit $categorieProduit, EntityManagerInterface $manager){
        $manager->remove($categorieProduit);
        $manager->flush();

        return $this->redirectToRoute('admin-categorie-produits');
    }
}
