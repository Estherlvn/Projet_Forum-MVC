<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\MembreManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["categoryName", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function listTopicsByCategory($id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);
    
        // // Debugging: vérifier que $topics contient bien des données
        // var_dump($topics);
    
        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics // Changez ici le nom de la variable de "topic" à "topics"
            ]
        ];
    }



    public function listPostsByTopic($id) {
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        
        // Récupérer le topic pour afficher son titre ou autres infos
        $topic = $topicManager->findOneById($id);
        
        // Récupérer les posts du topic
        $posts = $postManager->findPostsByTopic($id);
        
        return [
            "view" => VIEW_DIR."forum/listPosts.php",  // Vue pour afficher les posts
            "meta_description" => "Liste des posts du topic : ".$topic->getTopicName(),
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }
    
    
    

    public function listMembres() {
        $userManager = new MembreManager();
        // Récupérer tous les membres
        $membres = $membreManager->findAll();


        return [
            "view" => VIEW_DIR . "forum/listMembres.php", // Chemin de la vue
            "meta_description" => "Liste des membres du forum",
            "data" => [
                "membres" => $membres // On passe les membres à la vue
            ]
        ];
    }
}