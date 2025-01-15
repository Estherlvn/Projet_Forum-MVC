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


    // Ajouter un membre dans la base de données
    public function add($data) {
    $sql = "INSERT INTO " . $this->tableName . " (pseudo, email, password, role) VALUES (:pseudo, :email, :password, :role)";
    DAO::select($sql, [
        'pseudo' => $data['pseudo'],
        'email' => $data['email'],
        'password' => $data['password'],
        'role' => $data['role'] 
    ]);
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
        $sql = "SELECT * FROM " . $this->tableName . " WHERE pseudo = :pseudo";
        $row = DAO::select($sql, ['pseudo' => $pseudo], false); // Voir méthode pour requêtes de type SELECT dans DAO
    
        // Debug: Voir ce que contient la variable $row
        // var_dump($row); // Vérifiez si les données retournées sont bien un tableau associatif
    
        return $this->getOneOrNullResult($row, $this->className);
    }
    

    // Trouver un membre par email
    public function findByEmail($email) {
        $sql = "SELECT * FROM ".$this->tableName." WHERE email = :email";
        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email]),
            $this->className
        );
    }

    // Trouver un membre par ID
    public function findById($id) {
    $sql = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
    return $this->getOneOrNullResult(
        DAO::select($sql, ['id' => $id]),
        $this->className
        );
    }

    // Mettre à jour un membre dans la base de données
    public function update($data) {
    $sql = "UPDATE " . $this->tableName . " SET pseudo = :pseudo, email = :email, password = :password, role = :role WHERE id = :id";
    DAO::select($sql, [
        'id' => $data['id'],
        'pseudo' => $data['pseudo'],
        'email' => $data['email'],
        'password' => $data['password'],
        'role' => $data['role']
        ]);
    }


}
