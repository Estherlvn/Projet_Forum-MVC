<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) {

        // Préparation de la requête SQL pour récupérer les topics d'une catégorie spécifique
        $sql = "SELECT t.*, c.categoryName, m.pseudo 
                FROM ".$this->tableName." t
                INNER JOIN category c ON t.category_id = c.id_category
                INNER JOIN membre m ON t.membre_id = m.id_membre
                WHERE t.category_id = :id";
       

        // Exécution de la requête et récupération des résultats
        $results = DAO::select($sql, ['id' => $id]);

        var_dump($results);
        
        // Retourner les résultats en utilisant la méthode getMultipleResults
        return $this->getMultipleResults($results, $this->className);
    }
    
    
}