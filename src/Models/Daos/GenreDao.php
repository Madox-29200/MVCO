<?php

namespace cinema\Models\Daos;

use cinema\models\entites\Genre;

class GenreDao extends BaseDao
{
    public function findAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM genre");
        $res = $stmt->execute();
        
        if ($res){
            $genre = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
            {
                $genre[] = $this->createObjectFromFields($row);
            }
            return $genre;
        }else{
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    }    

    public function findByMovie($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM genre, movie WHERE genre.id = movie.genre_id AND movie.id = $id");
        $res = $stmt->execute();
        if ($res){            
            return $stmt->fetchObject(Genre::class);            
        }else{
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    }


    public function insert($genreData)
    {   
        $sql=$this->db->prepare("INSERT INTO genre (name) VALUES (?)");
        $sql->execute(array($genreData->getNom()));
    }


    public function createObjectFromFields($fields)
    {
        $genre = new Genre ();
        $genre->setId($fields['id'])->setNom($fields['name']);

        return $genre;
    }
        
    
}