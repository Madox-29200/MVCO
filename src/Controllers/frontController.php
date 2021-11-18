<?php

namespace cinema\controllers;


use cinema\Models\Services\GenreService;
use cinema\Models\Services\ActorService;
use cinema\Models\Services\DirectorService;
use cinema\Models\Services\MovieService;

use Twig\Environment;


class FrontController {

    private $genreService ;
    private $twig;

    public function index(){
        
        echo "<h1>Hello World !</h1>";
    }

    public function __construct($twig)
    {
        $this->genreService=new genreService;
        $this->actorService=new actorService;
        $this->directorService=new directorService;
        $this->movieService=new movieService;
        $this->twig = $twig;
        
    }

    public function genres(){   
        
        $genres = $this->genreService->getAllgenres();

        echo $this->twig->render('genres.html.twig', [ "genres" => $genres ] );
    }


    public function actors(){
        
        $actors = $this->actorService->getAllActors();        
        echo $this->twig->render('actors.html.twig', [ "actors" => $actors ] );        
    }

    public function directors(){
        
        $directors = $this->directorService->getAllDirectors();
        // montreMoi($directors);    
        echo $this->twig->render('directors.html.twig', [ "directors" => $directors ] );        
    }

    public function movies(){
        
        $movies = $this->movieService->getAllMovies();

        $movie = $this->movieService->getById($movies->getId());
        $acteurs    = $this->actorService->getAllActors();
        $dejaDedans = $movie->getActors();
           
    //
    // filtrage des acteurs (certains sont déjà sélectionnés)
    //
        if(empty($dejaDedans)){
            $restes = $acteurs;            
        }else{
            $restes = array_udiff($acteurs,$dejaDedans,
                function ($a, $b) {
                    return $a->getId() - $b->getId();
                    }
            ); 
        }
        // montreMoi($movies);   
        echo $this->twig->render('movies.html.twig', [ "movies" => $movies ] );

    }

    public function movie($id)
    {
        $movie = $this->movieService->getById($id);       
        // montreMoi($movie);
        
        echo $this->twig->render('movie.html.twig', [ "movie" => $movie] );
    }

    public function addgenre()
    {        
        echo $this->twig->render('addgenre.html.twig');
    }

    public function adddirector()
    {        
        echo $this->twig->render('adddirector.html.twig');
    }

    public function addactor()
    {        
        echo $this->twig->render('addactor.html.twig');
    }

    public function addmovie()
    {
        $genres = $this->genreService->getAllgenres();
        $directors = $this->directorService->getAllDirectors();
        echo $this->twig->render('addmovie.html.twig',  ["genres" => $genres, "directeurs" => $directors]);
    }

    
} 
?>