<?php

namespace App\Controller;

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
