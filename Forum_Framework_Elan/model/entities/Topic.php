<?php
namespace Model\Entities;

use App\Entity;

final class Topic extends Entity {

    private $id; // Correspond à la colonne id_topic dans BDD
    private $topicName;
    private $topicDate;
    private $topicStatus;
    private $membre;  // clé étrangère membre_id
    private $category;  // clé étrangère category_id

    public function __construct($data) {
        $this->hydrate($data);
    }

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     * @return self
     */
    public function setId($id) {
        $this->id = $id;
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
     * @param string $topicName
     * @return self
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
     * @param \DateTime $topicDate
     * @return self
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
     * @param bool $topicStatus
     * @return self
     */
    public function setTopicStatus($topicStatus) {
        $this->topicStatus = $topicStatus;
        return $this;
    }

    /**
     * Get the value of membre
     */
    public function getMembre() {
        return $this->membre;
    }

    /**
     * Set the value of membre
     *
     * @param \Model\Entities\User $membre
     * @return self
     */
    public function setMembre($membre) {
        $this->membre = $membre;
        return $this;
    }

    /**
     * Get the value of category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @param \Model\Entities\Category $category
     * @return self
     */
    public function setCategory($category) {
        $this->category = $category;
        return $this;
    }

    public function __toString() {
        return $this->topicName;
    }
}
