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
        $protected_content = "<h1>blibli</h1>";
        $unprotected_content = "<h3>blublu</h3>";
        return $this->render("default/test.html.twig", [
            'protected_content'=>$protected_content,
            'unprotected_content'=>$unprotected_content,]);
    }
}