<?php
namespace Model\Entities;

use App\Entity;

final class Category extends Entity {

    private $id_category; // Correspond à la colonne id_category
    private $categoryName; // Correspond à la colonne categoryName

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id_category
     */ 
    public function getIdCategory()
    {
        return $this->id_category;
    }

    /**
     * Set the value of id_category
     *
     * @return  self
     */ 
    public function setIdCategory($id_category)
    {
        $this->id_category = $id_category;
        return $this;
    }

    /**
     * Get the value of categoryName
     */ 
    public function getCategoryName(){
        return $this->categoryName;
    }

    /**
     * Set the value of categoryName
     *
     * @return  self
     */ 
    public function setCategoryName($categoryName){
        $this->categoryName = $categoryName;
        return $this;
    }

    public function __toString(){
        return $this->categoryName; // Affiche le nom de la catégorie
    }
}
