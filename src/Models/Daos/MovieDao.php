<?php
namespace cinema\Models\Daos;

use cinema\Models\Entites\Movie;

class MovieDao extends BaseDao
{
    public function findAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM movie");
        $res = $stmt->execute();
        
        if ($res){
            $movie = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
            {
                $movie[] = $this->createObjectFromFields($row);
            }
            return $movie;
        }else{
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    }

    
    public function create (Movie $movie)
    {
        $stmt = $this->db->prepare("INSERT INTO `movie`(`id`, `title`, `description`, `duration`, `date`, `cover_image`, `genre_id`, `director_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    }
    
    
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM movie WHERE id = $id");
        $res = $stmt->execute();        
        if ($res){                
            return $this->createObjectFromFields($stmt->fetch(\PDO::FETCH_ASSOC));                
        }else{
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    } 
    
    public function insert($movie)
    {
        // m($movie);
       $title=$movie->getTitle();
       $des=$movie->getDescription();
       $duration=$movie->getDuration();
       $date=$movie->getDate()->format('Y-m-d');
       $image=$movie->getCoverImage();
       $genreId=$movie->getIdgenre();
       $dirId=$movie->getIddirector();
        $sql=$this->db->prepare("INSERT INTO movie(title, description, duration, date, cover_image, genre_id, director_id) VALUES (?,?,?,?,?,?,?)");
        $sql->execute(array($title,$des,$duration,$date,$image,$genreId,$dirId));
    }
      
    
    public function createObjectFromFields($fields): Movie
    {
        $movie = new Movie();
        $movie->setId($fields['id'])
            ->setTitle($fields['title'])
            ->setDescription($fields['description'])
            ->setDate(\DateTime::createFromFormat('Y-m-d', $fields['date']))
            ->setCoverImage($fields['cover_image'])
            ->setDuration($fields['duration'])
            ->setIdgenre($fields['genre_id'])
            ->setIddirector($fields['director_id']);
    
        return $movie;
    }
}