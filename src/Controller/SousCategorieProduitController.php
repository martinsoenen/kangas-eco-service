<?php


namespace App\Controller;


use App\Entity\CategorieProduit;
use App\Entity\SousCategorieProduit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SousCategorieProduitController extends AbstractController
{
    /**
     * @Route("/admin/produits/sous-categorie", name="admin_souscategorie_produits")
     */
    public function afficherSousCategorieProduit()
    {
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){
            $repo = $this->getDoctrine()->getRepository(SousCategorieProduit::class);
            $souscategories = $repo->findAll();
            return $this->render('product/afficherSousCategorieProduit.html.twig', [
                'controller_name' => 'SousCategorieProduitController',
                'souscategories' => $souscategories
            ]);
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/admin/produit/souscategorie/add", name="ajouter_souscategorie_produit")
     * @Route("/admin/produit/souscategorie/{id}/edit", name="modifier_souscategorie_produit")
     */
    public function ajouterSousCategorieProduit(SousCategorieProduit $sousCategorieProduit = null,Request $request,EntityManagerInterface $manager)
    {

        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){
            $editmode = true;
            if(!$sousCategorieProduit) {
                $sousCategorieProduit = new sousCategorieProduit();
                $editmode = false;
            }
            $form = $this->createFormBuilder($sousCategorieProduit)
                ->add('nom',TextType::class,array('required'  => true))
                ->add('CategorieProduit',EntityType::class,[
                    'class' => CategorieProduit::class,
                    'choice_label' => 'Nom',
                    'required'  => true,
                ])
                ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted()&& $form->isValid()) {

                $manager->persist($sousCategorieProduit);
                $manager->flush();
                return $this->redirectToRoute('admin_souscategorie_produits');
            }

            return $this->render('product/ajouterSousCategorieProduit.html.twig', [
                'controller_name' => 'SousCategorieProduitController',
                'formSousCategorieProduit'=> $form->createView(),
                'editMode'=>$editmode,
            ]);
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }

    /**
     *  @Route("/admin/produit/souscategorie/{id}/delete", name="delete_souscategorie_produit")
     */
    public function deleteSousCategorieProduit(SousCategorieProduit $sousCategorieProduit, EntityManagerInterface $manager){
        
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){

            $manager->remove($sousCategorieProduit);
            $manager->flush();

            return $this->redirectToRoute('admin-souscategorie-produits');
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }
}