<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Tmdb\TmdbCaller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TmdbController extends AbstractController {
    /**
     * @Route("/tmdb", name="tmdb")
     * @param TmdbCaller $tmdbCaller
     * @return Response
     */
    public function index(TmdbCaller $tmdbCaller) {
        //à quelle page on commence ?
        $startAtPage = 1;

        //on va chercher plusieurs pages à la fois...
        for ($i = $startAtPage; $i <= ($startAtPage + 10); $i++) {
            //pour ralentir, au besoin
            //sleep(1);
            //voir fonction ci-dessous
            $tmdbCaller->getMoviesFromTmdb($i);
        }

        $this->addFlash("success", "Base mise à jour.");

        //        return new Response("done");
        return $this->redirectToRoute("serie_list");
    }

}

