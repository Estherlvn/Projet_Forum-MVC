<?php
namespace Model\Entities;

use App\Entity;

final class Topic extends Entity {

    private $id_topic;
    private $topicName;
    private $topicDate;
    private $topicStatus;
    private $membre_id;  // Clé étrangère pour l'utilisateur
    private $category_id;  // Clé étrangère pour la catégorie

    public function __construct($data) {
        $this->hydrate($data);
    }

    /**
     * Get the value of id_topic
     */ 
    public function getId() {
        return $this->id_topic;
    }

    /**
     * Set the value of id_topic
     *
     * @return  self
     */ 
    public function setId($id_topic) {
        $this->id_topic = $id_topic;
        return $this;
    }

    /**
     * Get the value of topicName
     */ 
    public function getTopicName() {
        return $this->topicName;
    }

    /**
     * Set the value of topicName
     *
     * @return  self
     */ 
    public function setTopicName($topicName) {
        $this->topicName = $topicName;
        return $this;
    }

    /**
     * Get the value of topicDate
     */ 
    public function getTopicDate() {
        return $this->topicDate;
    }

    /**
     * Set the value of topicDate
     *
     * @return  self
     */ 
    public function setTopicDate($topicDate) {
        $this->topicDate = $topicDate;
        return $this;
    }

    /**
     * Get the value of topicStatus
     */ 
    public function getTopicStatus() {
        return $this->topicStatus;
    }

    /**
     * Set the value of topicStatus
     *
     * @return  self
     */ 
    public function setTopicStatus($topicStatus) {
        $this->topicStatus = $topicStatus;
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
     * Get the value of category_id
     */ 
    public function getCategoryId() {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */ 
    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
        return $this;
    }

    public function __toString() {
        return $this->topicName;
    }
}
