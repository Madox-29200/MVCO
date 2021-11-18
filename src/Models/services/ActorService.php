<?php

namespace cinema\Models\Services;
use cinema\Models\Daos\ActorDao;

class ActorService
{
    Private $actorDao;

    public function __construct()
    {
    $this->actorDao = new ActorDao();
    }

    public function getAllActors()
    {
        $actors = $this->actorDao->findAll();
        return $actors;
    }

    public function getById($id)
    {
        $Actor = $this->ActorDao->findById($id);
        return $Actor;
    }

    public function create($actorData)
    {
        $actor = $this->actorDao->createObjectFromFields($actorData);
        $this->actorDao->insert($actor);
    }
}

?>