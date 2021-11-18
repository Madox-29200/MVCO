<?php

namespace cinema\Models\entites;

class Genre{
    private $id;
    private $nom;

    public function setNom($nom){
        $this->nom = $nom;
        return $this;
    }

    public function setId(int $id=null){
        $this->id = $id;
        return $this;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getId(){
        return $this->id;
    }
}



?>