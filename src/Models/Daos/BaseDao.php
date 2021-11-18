<?php
namespace cinema\Models\Daos;

// DAO = Date Access Object

use PDO;

class BaseDao
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO("mysql://host=localhost;dbname=cinesite;charset=utf8", 'root', '');
    }
}