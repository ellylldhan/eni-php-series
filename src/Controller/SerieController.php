<?php

namespace App\Controller;

use App\Entity\Serie;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController {
    /**
     * @Route("/serie", name="serie_list")
     */
    public function list() {
        // Récupére les séries en bdd
        $serieRepo = $this->getDoctrine()->getRepository(Serie::class);
        // SELECT * un peu bourrin
//        $series = $serieRepo->findAll();

        // SELECT TOP 30 * WHERE .. ORDER BY -- plus raffiné
        $series = $serieRepo->findBy([], ["vote" => "DESC"], 30, 0);

        return $this->render('serie/list.html.twig', [
            "series" => $series
        ]);
    }

    /**
     * @Route("/serie/{id}", name="serie_detail",
     *     requirements={"id": "\d+"}, methods={"GET"})
     */
    public function detail($id) {
        // Récupère le repo
        $serieRepo = $this->getDoctrine()->getRepository(Serie::class);

        // Récupère une série
        $serie = $serieRepo->find($id);
        return $this->render('serie/detail.html.twig', ["serie" => $serie]);
    }

    /**
     * @Route("/serie/add", name="serie_add")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function add(EntityManagerInterface $em) {
        //@todo : ajoute une série = traiter le formulaire...

        // Création d'une serie
        $serie = new Serie();
        $serie->setName("piiiif");
        $serie->setOverview("lorem overview ipsum");
        $serie->setTmdbId(124);
        $serie->setDateCreated(new \DateTime());
        $serie->setDateModified(new \DateTime());

        // Sauvegarde
        $em->persist($serie);
        $em->flush();

        // Modification post-flush
        $serie->setGenres("horror");
        $em->persist($serie);
        $em->flush();

        // Suppression
        $em->remove($serie);
        $em->flush();

        return $this->render('serie/add.html.twig', []);
    }
}
