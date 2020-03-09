<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    const NB_BLOGS_PER_PAGE = 5;
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
