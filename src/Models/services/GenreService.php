<?php


namespace cinema\Models\Services;

use cinema\Models\Daos\GenreDao;


class GenreService

{
    Private $genreDao;

    public function __construct()
    {
    $this->genreDao = new GenreDao();
    }

    public function getAllGenres()
    {
        $genres = $this->genreDao->findAll();
        return $genres;
    }


    public function create($genreData)
    {
        $genre = $this->genreDao->createObjectFromFields($genreData);
        $this->genreDao->insert($genre);
    }
}