<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class CategoryManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Category";
    protected $tableName = "category";

    public function __construct(){
        parent::connect();
    }


    // Ajouter une méthode spécifique pour une requête personnalisée
    public function findAllCategories() {
        
        $sql = "SELECT * FROM ".$this->tableName." ORDER BY categoryName ASC";
        return $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }
    

    




}