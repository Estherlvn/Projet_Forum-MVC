<?php
namespace Model\Entities;

use App\Entity;

final class Post extends Entity {

    // Attributs d'un post
    private $id_post;
    private $postContent;
    private $postDate;
    private $topic_id;   // Clé étrangère vers le topic
    private $membre_id;  // Clé étrangère vers l'utilisateur (auteur)

    // Constructeur pour hydrater l'objet
    public function __construct($data) {         
        $this->hydrate($data);        
    }

    // Getters et Setters pour chaque attribut

    /**
     * Get the value of id_post
     */ 
    public function getId() {
        return $this->id_post;
    }

    /**
     * Set the value of id_post
     *
     * @return  self
     */ 
    public function setId($id_post) {
        $this->id_post = $id_post;
        return $this;
    }

    /**
     * Get the value of postContent
     */ 
    public function getPostContent() {
        return $this->postContent;
    }

    /**
     * Set the value of postContent
     *
     * @return  self
     */ 
    public function setPostContent($postContent) {
        $this->postContent = $postContent;
        return $this;
    }

    /**
     * Get the value of postDate
     */ 
    public function getPostDate() {
        return $this->postDate;
    }

    /**
     * Set the value of postDate
     *
     * @return  self
     */ 
    public function setPostDate($postDate) {
        $this->postDate = $postDate;
        return $this;
    }

    /**
     * Get the value of topic_id
     */ 
    public function getTopicId() {
        return $this->topic_id;
    }

    /**
     * Set the value of topic_id
     *
     * @return  self
     */ 
    public function setTopicId($topic_id) {
        $this->topic_id = $topic_id;
        return $this;
    }

    /**
     * Get the value of membre_id
     */ 
    public function getMembreId() {
        return $this->membre_id;
    }

    /**
     * Set the value of membre_id
     *
     * @return  self
     */ 
    public function setMembreId($membre_id) {
        $this->membre_id = $membre_id;
        return $this;
    }

    /**
     * Méthode pour afficher le post sous forme de chaîne de caractères
     */ 
    public function __toString() {
        return substr($this->postContent, 0, 100) . "...";
    }
}
