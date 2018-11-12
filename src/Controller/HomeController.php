<?php
/**
 * Created by PhpStorm.
 * User: vince
 * Date: 22/10/18
 * Time: 19:37
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{

    /**
     * @Route ("/", name="homepage")
     * @return Response
     */

    public function index(){

        return $this->render('home.html.twig');

    }
}