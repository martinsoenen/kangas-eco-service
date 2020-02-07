<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaTypeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     * @Route("/blog/index", name="blog_index")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' =>$articles
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
     * @Route("/admin/blog", name="blog_admin"))
     */
    public function showAdminBlog()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();

        return $this->render('blog/adminBlog.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles,
        ]);
    }
      /**
     * @Route("/admin/articles", name="articles_admin"))
     */
    public function showAdminArticles()
    {
        return $this->render('blog/adminArticles.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/admin/article/add", name="add_article_admin"))
     */
    public function addAdminArticles(Article $article = null,Request $request,EntityManagerInterface $manager)
    {
        if(!$article) {
            $article = new Article();
        }
        $form = $this->createFormBuilder($article)

            ->add('Titre', TextType::class,array('required'  => true))
            ->add('Text', TextareaType::class,array('required'  => true))
            ->add('Image', FileType::class,array('required'  => true))
            ->getForm();


        $form->handleRequest($request);


        if($form->isSubmitted()&& $form->isValid()) {
            $article->setDate(new \DateTime());
            $article->setUtilisateurAdmin(null);
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_admin');
        }

        return $this->render('blog/ajouterArticles.html.twig', [
            'controller_name' => 'BlogController',
            'formArticle'=> $form->createView(),
            'editMode'=>$article->getId() !== null,
        ]);
    }
}
