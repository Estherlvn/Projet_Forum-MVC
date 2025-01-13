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
        
        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }

    // Trouver un membre par pseudo
    public function findByPseudo($pseudo) {
        $sql = "SELECT * FROM ".$this->tableName." WHERE pseudo = :pseudo";
        return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' => $pseudo]),
            $this->className
        );
    }

    // Trouver un membre par email
    public function findByEmail($email) {
        $sql = "SELECT * FROM ".$this->tableName." WHERE email = :email";
        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email]),
            $this->className
        );
    }
}
