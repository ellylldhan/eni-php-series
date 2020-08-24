<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    /**
     * @Route("/")
     */
    public function home() {
        // Afficher du html pur dans la page
//        return new Response('Hello World!');
        return $this->render("default/home.html.twig");
    }
}