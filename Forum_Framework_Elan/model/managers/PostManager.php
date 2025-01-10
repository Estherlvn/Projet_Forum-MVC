<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findPostsByTopic($id) {

        // Préparation de la requête SQL pour récupérer les posts d'un topic spécifique
        $sql = "SELECT p.*, t.topicName, m.pseudo 
                FROM ".$this->tableName." p
                INNER JOIN topic t ON p.topic_id = t.id_topic
                INNER JOIN membre m ON p.membre_id = m.id_membre
                WHERE p.topic_id = :id
                ORDER BY postDate ASC";
       

        // Exécution de la requête et récupération des résultats
        $results = DAO::select($sql, ['id' => $id]);

        
        // Retourner les résultats en utilisant la méthode getMultipleResults
        return $this->getMultipleResults($results, $this->className);
    }

    
    
}