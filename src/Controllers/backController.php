<?php

namespace cinema\controllers;


use cinema\Models\Services\GenreService;
use cinema\Models\Services\DirectorService;
use cinema\Models\Services\ActorService;
use cinema\Models\Services\MovieService;


class BackController
{
    private $genreService ; 
    private $directorService ;     
    private $actorService;
    private $movieService;

    public function __construct()
    {
        $this->genreService = new genreService();   
        $this->directorService = new directorService(); 
        $this->actorService = new actorService(); 
        $this->movieService = new movieService();     
    }

    public function addGenre($genreData)
    {
        $this->genreService->create($genreData);
    }  
    
    public function addDirector($directorData)
    {
        $this->directorService->create($directorData);
    }  

    public function addActor($actorData)
    {
        $this->actorService->create($actorData);
    }  

    public function addMovie($movieData)
    {
        $this->movieService->create($movieData);
    }  
} 
?>