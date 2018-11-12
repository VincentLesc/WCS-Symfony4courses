<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @package App\Controller
 *
 * @Route("/blog")
 */

class BlogController extends AbstractController
{
    /**
     * Show all row from article's entity
     * @Route("/home", name="blog_home")
     */
    public function index()
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }
        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
        );
    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     */
    public function show($slug)
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with '.$slug.' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/show.html.twig',
            [
                'article' => $article
            ]
        );
    }

    /**
     * Getting all articles by category;
     *
     * @param string $category The category
     *
     * @Route("/category/{category}",name="blog_show_category")
     */
    public function showByCategory(string $category)
    {

        $details = $this->getDoctrine()->getRepository(Category::class);
        $details = $details->findOneByName($category);
        $articles = $this->getDoctrine()->getRepository(Article::class)->findBy(['category'=> $details->getId()], ['id'=>'DESC'], 3);
        if (!$details) {
            throw $this->createNotFoundException('No category or articles find for'.$category);
        }

        return $this->render('blog/category.html.twig', [
            'category' => $details,
            'articles'=>$articles
        ]);
    }


}
