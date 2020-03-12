<?php

namespace App\Controller;

use App\Entity\CategorieProduit;
use App\Entity\Produit;
use App\Entity\SousCategorieProduit;
use App\Entity\UtilisateurAdministration;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;

class ProductController extends AbstractController
{
    const NB_BLOGS_PER_PAGE = 12;
    /**
     * @Route("/magasin", name="magasin")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        if($this->getUser()!=null) {
            if($this->getUser()->getUtilisateurType()!="pro" ){
        
            $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
                $pagination = $paginator->paginate(
                    $produits,
                    $request->query->getInt('page', 1),
                    self::NB_BLOGS_PER_PAGE
                );
            $categories = $this->getDoctrine()->getRepository(CategorieProduit::class)->findCategories();

            return $this->render('product/index.html.twig', [
                'controller_name' => 'ProductController',
                'produits' => $pagination,
                'categories' => $categories
            ]);
            
            }
            else{
                $this->addFlash('error', 'Vous avez un compte entreprise. Accès refusé.');
                return $this->redirectToRoute('home');
            }
        }else{
            $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
            $categories = $this->getDoctrine()->getRepository(CategorieProduit::class)->findCategories();

            return $this->render('product/index.html.twig', [
                'controller_name' => 'ProductController',
                'produits' => $produits,
                'categories' => $categories
            ]);
        }
    }

    /**
     * @Route("/magasin/recherche", name="magasin_search", methods={"GET","POST"})
     */
    public function magasinRecherche(Request $request)
    {
//        $request->query->get('name');

        $produits = $this->getDoctrine()->getRepository(Produit::class)->findBySearch($request->query->get('name'));
        $categories = $this->getDoctrine()->getRepository(CategorieProduit::class)->findCategories();

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'produits' => $produits,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/magasin/categorie/{id}", name="categorie_produit")
     * @Entity("CategorieProduit", expr="repository.find(id)")
     */
    public function categorie(CategorieProduit $categorie)
    {
        if($this->getUser()!=null) {

            if($this->getUser()->getUtilisateurType()!="pro" ){
                $id = $categorie->getId();
                $categories = $this->getDoctrine()->getRepository(CategorieProduit::class)->findCategories();
                $produits = $this->getDoctrine()->getRepository(Produit::class)->findProduitsByCategorie($id);

                return $this->render('product/showByCategorie.html.twig', [
                    'controller_name' => 'ProductController',
                    'categorie' => $categorie,
                    'categories' => $categories,
                    'produits' => $produits
                ]);
            }else{
                $this->addFlash('error', 'Vous avez un compte entreprise. Accès refusé.');
                return $this->redirectToRoute('home');
            }
        }else{
                $id = $categorie->getId();
                $categories = $this->getDoctrine()->getRepository(CategorieProduit::class)->findCategories();
                $produits = $this->getDoctrine()->getRepository(Produit::class)->findProduitsByCategorie($id);

                return $this->render('product/showByCategorie.html.twig', [
                    'controller_name' => 'ProductController',
                    'categorie' => $categorie,
                    'categories' => $categories,
                    'produit' => $produits
                ]);
            }
    }

    /**
     * @Route("/magasin/sous-categorie/{id}", name="sous_categorie_produit")
     * @Entity("SousCategorieProduit", expr="repository.find(id)")
     */
    public function sous_categorie(SousCategorieProduit $souscategorie)
    {
        
        if($this->getUser() !=null ){

            if($this->getUser()->getUtilisateurType()!="pro" ){
                $id = $souscategorie->getId();
                $categories = $this->getDoctrine()->getRepository(CategorieProduit::class)->findCategories();
                $produits = $this->getDoctrine()->getRepository(Produit::class)->findProduitsBySousCategorie($id);

                return $this->render('product/showBySousCategorie.html.twig', [
                    'controller_name' => 'ProductController',
                    'categories' => $categories,
                    'souscategorie' => $souscategorie,
                    'produits' => $produits
                ]);
            }else{
                $this->addFlash('error', 'Vous avez un compte entreprise. Accès refusé.');
                return $this->redirectToRoute('home');
            }
        }else{

            $id = $souscategorie->getId();
            $produits = $this->getDoctrine()->getRepository(Produit::class)->findProduitsBySousCategorie($id);

            return $this->render('product/showBySousCategorie.html.twig', [
                'controller_name' => 'ProductController',
                'souscategorie' => $souscategorie,
                'produits' => $produits
            ]);
        }
    }

    /**
     * @Route("/magasin/produit_{id}", name="magasin_produit")
     * @Entity("Produit", expr="repository.find(id)")
     */
    public function show(Produit $produit)
    {
        $categories = $this->getDoctrine()->getRepository(CategorieProduit::class)->findCategories();

        return $this->render('product/show.html.twig', [
            'controller_name' => 'ProductController',
            'categories' => $categories,
            'produit' => $produit
        ]);
    }

    /**
     * @Route("/admin/produits", name="admin_produits")
     */
    public function admin_show()
    {
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){
            $repo = $this->getDoctrine()->getRepository(Produit::class);
            $produits = $repo->findAll();
            return $this->render('product/admin_show.html.twig', [
                'controller_name' => 'ProductController',
                'produits' => $produits
            ]);
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/admin/produit/add", name="ajouter_produit")
     * @Route("/admin/produit/{id}/edit", name="modifier_produit")
     */
    public function ajouterProduit(Produit $produit = null,Request $request,EntityManagerInterface $manager)
    {
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){
            $editmode = true;
            if(!$produit) {
                $produit = new Produit();
                $editmode = false;
            }
            $form = $this->createFormBuilder($produit)
                ->add('Nomproduit',TextType::class,array('required'  => true))
                ->add('PrixunitaireHT',NumberType::class,array('required'  => true))
                ->add('TauxTVA',NumberType::class,array('required'  => true))
                ->add('Presentation',TextType::class,array('required'  => true))
                ->add('Descriptiondetaillee',TextareaType::class,array('required'  => true))
                ->add('SousCategorieProduit',EntityType::class,[
                    'class' => SousCategorieProduit::class,
                    'choice_label' => 'Nom',
                    'required'  => true,
                ])
                // ->add('UtilisateurAdmin',EntityType::class,[
                //     'class' => UtilisateurAdministration::class,
                //     'choice_label' => 'Nom',
                //     'required'  => true,
                // ])
                ->add('Image', FileType::class, [
                    'label' => 'Image',
                    'mapped' => false,
                    'required' => true,
                    'constraints' => [
                        new File([
                            'maxSize' => '2048k',
                            'mimeTypes' => [
                                "image/png",
                                "image/jpeg",
                                "image/jpg",
                                "image/gif",
                            ],
                            'mimeTypesMessage' => 'Uploadez un format d\'image valide (jpg, jped, png ou gif)'
                        ])
                    ],
                ])
                ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted()&& $form->isValid()) {
                $ImageFile = $form->get('Image')->getData();
                $originalFilename = pathinfo($ImageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$ImageFile->guessExtension();
                $ImageFile->move(
                    $this->getParameter('image_produit_directory'),
                    $newFilename
                );
                $produit->setImage($newFilename);

                $manager->persist($produit);
                $manager->flush();
                return $this->redirectToRoute('admin_produits');
            }

            return $this->render('product/ajouterProduit.html.twig', [
                'controller_name' => 'ProductController',
                'formProduit'=> $form->createView(),
                'editMode'=>$editmode,
            ]);
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }

    /**
     *  @Route("/admin/produit/{id}/delete", name="delete_produit")
     */
    public function deleteProduit(Produit $produit, EntityManagerInterface $manager){
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){
            $manager->remove($produit);
            $manager->flush();

            return $this->redirectToRoute('admin-produits');
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }
}
