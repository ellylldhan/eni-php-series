<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
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

        // SELECT TOP 30 * WHERE .. ORDER BY -- plus raffiné
//        $series = $serieRepo->findBy([], ["vote" => "DESC"], 30, 0);
        $series = $serieRepo->findBy([], ["name" => "ASC"], 30, 0);
//        $series = $serieRepo->findGoodSeries();

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
    public function add(EntityManagerInterface $em, Request $request) {
        //@todo : ajoute une série = traiter le formulaire...
        $serie = new Serie();
        $serie->setDateCreated(new \DateTime());

        $serieForm = $this->createForm(SerieType::class, $serie);

        // Pour traitement du formulaire
        $serieForm->handleRequest($request);

        // Vérif soumission
        if ($serieForm->isSubmitted() && $serieForm->isValid()) {
            // Ajout en BDD
            $em->persist($serie);
            $em->flush();

            // Affichage message flash pour dire "Yeah, done!"
            $this->addFlash("success", "The serie has been added.");

            // Redirige vers page détail
            return $this->redirectToRoute('serie_detail', [
                'id' => $serie->getId(),
            ]);
        }

        return $this->render('serie/add.html.twig', [
            "serieForm" => $serieForm->createView(),
        ]);
    }
}
