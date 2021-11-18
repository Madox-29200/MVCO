<?php

namespace cinema\Models\entites;

class Actor{
    private $id;
    private $prenom;
    private $nom;

    public function setNom($nom){
        $this->nom = $nom;
        return $this;
    }

    public function setId($id=null){
        $this->id = $id;
        return $this;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
        return $this;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getId(){
        return $this->id;
    }

}

?>