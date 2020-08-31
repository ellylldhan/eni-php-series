<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TmdbController extends AbstractController
{
    /**
     * @Route("/tmdb", name="tmdb")
     */
    public function index()
    {
        return $this->render('tmdb/index.html.twig', [
            'controller_name' => 'TmdbController',
        ]);
    }
}
