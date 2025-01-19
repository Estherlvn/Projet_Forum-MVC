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
 * Get the formatted topicDate with time zone conversion
 */
public function getTopicDateFormat() {
    // Utiliser UTC comme timezone d'origine si votre base de données est en UTC
    $date = new \DateTime($this->topicDate, new \DateTimeZone('UTC'));
    // Convertir en timezone Europe/Paris
    $date->setTimezone(new \DateTimeZone('Europe/Paris'));
    return $date->format('d-m-Y H:i');
}

/**
 * Set the value of topicDate
 *
 * @param string $topicDate Format de date en chaîne
 * @return self
 */
public function setTopicDate($topicDate) {
    $this->topicDate = $topicDate;
    return $this;
}

/**
 * Get the value of topicStatus
 *
 * @return int 0 for open, 1 for closed
 */
public function getTopicStatus() {
    return $this->topicStatus;
}

/**
 * Set the value of topicStatus
 *
 * @param int $topicStatus 0 for open, 1 for closed
 * @return self
 */
public function setTopicStatus($topicStatus) {
    $this->topicStatus = (int)$topicStatus;
    return $this;
}

/**
 * Check if the topic is open
 *
 * @return bool True if open, false if closed
 */
public function isOpen() {
    return $this->topicStatus === 0;
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
