<?php


namespace App\Controller;


use App\Entity\CategorieCollecte;
use App\Entity\Devis;
use App\Entity\ObjetCollecte;
use App\Entity\objetCollectes;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class CategorieCollecteController extends AbstractController
{
    /**
     * @Route("/admin/collecte/categorie", name="admin-collecte-categorie")
     */
    public function categorie_collecte_show()
    {
        $repo = $this->getDoctrine()->getRepository(CategorieCollecte::class);
        $categories = $repo->findAll();
        return $this->render('collecte/afficherCategorieCollecte.html.twig', [
            'controller_name' => 'ProductController',
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/admin/collecte/ajouter-categorie", name="ajouter_collecte_categorie")
     * @Route("/admin/collecte/{id}/edit", name="modifier_collecte_categorie")
     */
    public function ajouterCollecteCategorie(CategorieCollecte $categorie = null,Request $request,EntityManagerInterface $manager)
    {
        $editmode = true;
        if(!$categorie) {
            $categorie = new CategorieCollecte();
            $editmode = false;
        }
        $form = $this->createFormBuilder($categorie)
            ->add('nom',TextType::class,array('required'  => true))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()) {
            $manager->persist($categorie);
            $manager->flush();
            return $this->redirectToRoute('admin-collecte-categorie');
        }

        return $this->render('collecte/ajouterCategorieCollecte.html.twig', [
            'controller_name' => 'CategorieCollecteController',
            'formCategorieCollecte'=> $form->createView(),
            'editMode'=>$editmode,
        ]);
    }

    /**
     *  @Route("/admin/collecte/{id}/delete", name="delete_collecte_categorie")
     */
    public function deleteCollecteCategorie(CategorieCollecte $categorie , EntityManagerInterface $manager){
        $manager->remove($categorie);
        $manager->flush();

        return $this->redirectToRoute('admin-collecte-categorie');
    }
}