<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function showArticles(Article $article)
    {
        return $this->render('blog/articles.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/admin/blog", name="blog_admin"))
     */
    public function showAdminBlog()
    {
        return $this->render('blog/adminBlog.html.twig', [
            'controller_name' => 'BlogController',
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
}
