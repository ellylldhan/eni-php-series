<?php

namespace App\Tmdb;

use App\Entity\Serie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpClient\HttpClient;

class TmdbCaller {
    //pour que ce soit facile à changer
    //devrait plutôt être dans le fichier .env.local à vrai dire
//    const API_KEY = "f4cdc85408d87dd72a6b81a15f56a31c";
    const API_KEY = "520019fd9eb24943eff27c919154bcbb";

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine) {
        $this->doctrine = $doctrine;
    }

    public function getMoviesFromTmdb(int $page = 1) {
        //crée un client http, capable de faire des requêtes HTTP
        $client = HttpClient::create();

        //on ne peut pas utiliser l'interpolation de variable avec les constantes
        $url = "https://api.themoviedb.org/3/discover/movie?api_key=" . self::API_KEY . "&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&with_genres=878&page=$page";
        //déclenche notre requête à l'api de TMDB
        $response = $client->request('GET', $url);
        //convertie la réponse json (texte) en tableau
        $content = $response->toArray();

        $em        = $this->doctrine->getManager();
        $serieRepo = $this->doctrine->getRepository(Serie::class);

        foreach ($content['results'] as $serieData) {
            dump($content['results']);

            //on cherche le film dans la bdd pour éviter les doublons
            $foundExistingSerie = $serieRepo->findOneBy(['tmdbId' => $serieData['id']]);
//            if ($foundExistingSerie) {
//                echo "Serie exists !<br>";
//                continue;
//            }

            // https://developers.themoviedb.org/3/tv/get-tv-details
//            results            array[object] {TV List Result Object}
//            poster_path        string or null
//            popularity         number
//            id                 integer
//            backdrop_path      string or null
//            vote_average       number
//            overview           string
//            first_air_date     string
//            origin_country     array[string]
//            genre_ids          array[integer]
//            original_language  string
//            vote_count         integer
//            name               string
//            original_name      string
//            total_results      integer
//            total_pages        integer
            //crée un nouveau film et l'hydrate avec les données reçues
            $serie = new Serie();
            $serie->setPoster($serieData['poster_path']);
            $serie->setPopularity($serieData['popularity']);
            $serie->setTmdbId($serieData['id']);
            $serie->setBackdrop($serieData['backdrop_path']);
            $serie->setVote($serieData['vote_average']);
            $serie->setOverview($serieData['overview']);
            $serie->setFirstAirDate($serieData['first_air_date']);
            $serie->setGenres($serieData['genre_ids']);
            $serie->setName($serieData['original_name']);

            //on doit faire une autre requête pour récupérer les vidéos
//            $trailerId = $this->getTrailer($movieData['id']);
//            $movie->setTrailerId($trailerId);

            //sauvegarde chaque film
            $em->persist($serie);
        }

        //on exécute une seule fois, à la fin
        $em->flush();
    }

    //recupère la bande-annonce youtube en fonction de l'id du video de tmdb
    public function getTrailer($videoId) {
        $url    = "https://api.themoviedb.org/3/movie/$videoId?api_key=" . self::API_KEY . "&append_to_response=videos";
        $client = HttpClient::create();

        //déclenche notre requête à l'api de TMDB
        $response     = $client->request('GET', $url);
        $movieDetails = $response->toArray();
        if (!empty($movieDetails['videos'])) {
            //on boucle sur toutes les vidéos de ce film
            foreach ($movieDetails['videos']['results'] as $video) {
                //on cherche un trailer sur youtube
                if ($video['type'] === "Trailer" && $video['site'] === "YouTube") {
                    //si on le trouve, on retourne l'id sur youtube
                    return $video['key'];
                }
            }
        }

        //si on n'a pas trouvé, on arrive ici, et on retourne null
        return null;
    }
}
