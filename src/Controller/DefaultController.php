<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    /**
     * @Route("/")
     */
    public function home() {
        return $this->render("default/home.html.twig");
    }

    /**
     * @Route("/test")
     */
    public function test() {
        return $this->render("default/test.html.twig");
    }
}