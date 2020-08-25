<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController {
    /**
     * @Route("/serie", name="serie_list")
     */
    public function list() {
        //@todo : récupérer les séries en bdd

        return $this->render('serie/list.html.twig', []);
    }

    /**
     * @Route("/serie/{id}", name="serie_detail",
     *     requirements={"id": "\d+"}, methods={"GET"})
     */
    public function detail($id) {
        //@todo : récupérer une série en bdd

        return $this->render('serie/detail.html.twig', []);
    }

    /**
     * @Route("/serie/add", name="serie_add")
     */
    public function add() {
        //@todo : ajoute une série = traiter le formulaire...

        return $this->render('serie/add.html.twig', []);
    }
}
