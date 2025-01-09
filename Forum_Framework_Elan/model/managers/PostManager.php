<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager {

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct() {
        parent::connect();
    }

    /**
     * Récupérer tous les posts d'un topic spécifique
     *
     * @param int $topicId L'ID du topic
     * @return array Une liste de posts associés au topic
     */
    public function findPostsByTopic($topicId) {
        $sql = "SELECT p.*, m.pseudo 
                FROM ".$this->tableName." p
                INNER JOIN membre m ON p.membre_id = m.id_membre
                WHERE p.topic_id = :topic_id";

        return $this->getMultipleResults(
            DAO::select($sql, ['topic_id' => $topicId]), 
            $this->className
        );
    }

    /**
     * Ajouter un nouveau post
     *
     * @param array $data Les données du nouveau post
     * @return bool Retourne true si l'insertion a réussi
     */
    public function addPost($data) {
        $keys = array_keys($data);
        $values = array_values($data);

        $sql = "INSERT INTO ".$this->tableName." (".implode(',', $keys).") 
                VALUES ('".implode("','", $values)."')";

        return DAO::insert($sql);
    }

    /**
     * Supprimer un post
     *
     * @param int $postId L'ID du post à supprimer
     * @return bool Retourne true si la suppression a réussi
     */
    public function deletePost($postId) {
        $sql = "DELETE FROM ".$this->tableName." WHERE id_post = :id_post";
        return DAO::delete($sql, ['id_post' => $postId]);
    }
}
