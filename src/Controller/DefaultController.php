<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    /**
     * @Route("/", name="home")
     */
    public function home() {
        $series = ["Dexter",
                   "6 Feet Under",
                   "Les Bougons"];
//        $series = [];
        $titre = "Hello World!";

        return $this->render("default/home.html.twig", ["series" => $series, "titre"  => $titre,]);  // virgule en rab recommandée
    }

    /**
     * @Route("/test", name="test")
     */
    public function test() {
        return $this->render("default/test.html.twig");
    }
}