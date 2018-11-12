<?php

namespace App\Controller;

use App\Entity\Category;
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
     * @Route("/home/all", name="blog_home")
     */
    public function showAll()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class);
        $categories = $categories->findAll();

        return $this->render('blog/showall.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/{slug}", requirements={"slug"="([^A-Z_]+)"}, name="blog_show" )
     */
    public function show($slug = null)
    {
        if ($slug == null) {
            $slug = "Article Sans Titre";
        }
        else {
            $slug = str_replace("-", " ", $slug);
        }

        $slug = ucwords($slug);
        return $this->render('blog/index.html.twig', [
            'slug' => $slug
        ]);
    }


}
