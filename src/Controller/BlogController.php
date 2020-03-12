<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextareaTypeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    const NB_BLOGS_PER_PAGE = 6;
    /**
     * @Route("/blog", name="blog")
     * @Route("/blog/index", name="blog_index")
     */
    public function index(ArticleRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $articles = $repo->findAll();
        $pagination = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1),
            self::NB_BLOGS_PER_PAGE
        );

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $pagination,
        ]);
    }

    /**
     * @Route("/blog/article/{id}", name="blog_articles", methods={"GET","HEAD"}))
     */
    public function showArticles(ArticleRepository $repo, $id)
    {
        $article = $repo->find($id);

        return $this->render('blog/articles.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/admin/article", name="blog_admin"))
     */
    public function showAdminBlog()
    {
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){

            $repo = $this->getDoctrine()->getRepository(Article::class);
            $articles = $repo->findAll();

            return $this->render('blog/adminBlog.html.twig', [
                'controller_name' => 'BlogController',
                'articles' => $articles,
            ]);
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }
      /**
     * @Route("/admin/articles", name="articles_admin"))
     */
    public function showAdminArticles()
    {
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){

            return $this->render('blog/adminArticles.html.twig', [
                'controller_name' => 'BlogController',
            ]);
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/admin/article/add", name="add_article_admin"))
     * @Route("/admin/article/{id}/edit", name="edit_article_admin"))
     */
    public function addAdminArticles(Article $article = null,Request $request,EntityManagerInterface $manager)
    {
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){

            if(!$article) {
                $article = new Article();
            }
            $form = $this->createFormBuilder($article)

                ->add('Titre', TextType::class,array('required'  => true))
                ->add('Text', TextareaType::class,array('required'  => true))
                ->add('Image', FileType::class, [
                    'label' => 'Image',
                    'mapped' => false,
                    'required' => true,
                    'constraints' => [
                        new \Symfony\Component\Validator\Constraints\File([
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
                    $this->getParameter('image_article_directory'),
                    $newFilename
                );
                $article->setImage($newFilename);
                $article->setDate(new \DateTime());
                $manager->persist($article);
                $manager->flush();

                return $this->redirectToRoute('blog_admin');
            }

            return $this->render('blog/ajouterArticles.html.twig', [
                'controller_name' => 'BlogController',
                'formArticle'=> $form->createView(),
                'editMode'=>$article->getId() !== null,
            ]);
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }



    /**
     * @Route("/admin/article/{id}/delete", name="delete_article"))
     */
    public function deleteAdminArticles(Article $article,EntityManagerInterface $manager){
        if($this->getUser() != null && $this->getUser()->getUtilisateurType()=="admin"){

            $manager->remove($article);
            $manager->flush();

            return $this->redirectToRoute('blog_admin');
        }else{
            $this->addFlash('error', 'Vous avez un compte non admin. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }
}
