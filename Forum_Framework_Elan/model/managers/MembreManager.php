<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class MembreManager extends Manager {

    protected $className = "Model\Entities\User";
    protected $tableName = "membre";

    public function __construct() {
        parent::connect();
    }

    // Récupérer tous les membres
    public function findAll($order = null) {
        $orderQuery = ($order) ? "ORDER BY ".$order[0]." ".$order[1] : "";
        $sql = "SELECT * FROM ".$this->tableName." ".$orderQuery;
        
        // La méthode renvoie une liste de résultats
        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }
}
