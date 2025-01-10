<?php
namespace Model\Entities;

use App\Entity;

final class Post extends Entity {

    private $id;  // Correspond à id_post (clé primaire dans BDD)
    private $postContent;
    private $postDate;
    private $topic;   // Instance de Topic (clé étrangère topic_id dans BDD)
    private $membre;  // Instance de Membre (clé étrangère membre_id dans BDD)

    public function __construct($data) {         
        $this->hydrate($data);        
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getPostContent() {
        return $this->postContent;
    }

    public function setPostContent($postContent) {
        $this->postContent = $postContent;
        return $this;
    }

    public function getPostDate() {
        return $this->postDate;
    }

    public function setPostDate($postDate) {
        $this->postDate = $postDate;
        return $this;
    }

    public function getTopic() {
        return $this->topic;
    }

    public function setTopic($topic) {
        $this->topic = $topic;
        return $this;
    }

    public function getMembre() {
        return $this->membre;
    }

    public function setMembre($membre) {
        $this->membre = $membre;
        return $this;
    }

    public function __toString() {
        return substr($this->postContent, 0, 100) . "...";
    }
}
