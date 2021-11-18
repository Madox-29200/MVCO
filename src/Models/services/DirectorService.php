<?php

namespace cinema\Models\Services;
use cinema\Models\Daos\DirectorDao;


class DirectorService

{
    Private $directorDao;

    public function __construct()
    {
    $this->directorDao = new DirectorDao();
    }

    public function getAllDirectors()
    {
        $directors = $this->directorDao->findAll();
        return $directors;
    }

    public function create($directorData)
    {
        $director = $this->directorDao->createObjectFromFields($directorData); 
        $this->directorDao->insert($director);
    }

}

?>