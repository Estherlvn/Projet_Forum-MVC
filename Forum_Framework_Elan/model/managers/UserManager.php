<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager {

    protected $className = "Model\Entities\User";
    protected $tableName = "membre";

    public function __construct() {
        parent::connect();
    }

    // Récupérer tous les membres
    public function findAll() {
        $sql = "SELECT * FROM ".$this->tableName;
        
        // La méthode renvoie une liste de résultats
        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }
}
