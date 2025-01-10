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


    public function createPost($topic_id) {
        $postManager = new PostManager();
        $topicManager = new TopicManager();
    
        // Vérifier si le topic existe
        $topic = $topicManager->findOneById($topic_id);
        if (!$topic) {
            Session::addFlash('error', 'Le topic spécifié est invalide.');
            return $this->redirectTo("listTopicsByCategory", $topic->getCategoryId());
        }
    
        // Traitement du formulaire uniquement pour la requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postContent'])) {
            $postContent = filter_input(INPUT_POST, 'postContent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            if (empty($postContent)) {
                Session::addFlash('error', 'Le message ne peut pas être vide.');
                return $this->redirectTo("listPostsByTopic", $topic_id);
            }
    
            // Utilisation d'un utilisateur fixe temporaire (à changer pour la gestion des sessions)
            $membre_id = 1;  // Remplacer par l'ID de l'utilisateur connecté
    
            // Données préparées pour insertion
            $postData = [
                'postContent' => $postContent,
                'topic_id' => $topic_id,
                'membre_id' => $membre_id
            ];
    
            // Insertion du nouveau post
            $postManager->add($postData);
    
            Session::addFlash('success', 'Votre message a été ajouté avec succès.');
            return $this->redirectTo("listPostsByTopic", $topic_id);
        }
    
        // Affichage de la page si ce n'est pas une requête POST
        return [
            "view" => VIEW_DIR . "forum/listPosts.php",
            "data" => [
                "topic" => $topic,
                "posts" => $postManager->findPostsByTopic($topic_id)
            ]
        ];
    }    
    

    // créer un nouveau topic (topicName seulement)
    public function createTopic() {
 // Vérifier que les données du formulaire sont présentes
 if (!empty($_POST['topicName']) && !empty($_POST['category_id'])) {
    // Filtrage et validation des données
    $topicName = filter_input(INPUT_POST, 'topicName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

    // Vérification que la catégorie existe
    $categoryManager = new CategoryManager();
    $category = $categoryManager->findOneById($categoryId);

    if (!$category || !$topicName) {
        Session::addFlash('error', 'La catégorie spécifiée ou le nom du topic est invalide.');
        return $this->redirectTo("forum", "listTopicsByCategory", $categoryId);
    }

    // Créer une instance du TopicManager pour ajouter le topic
    $topicManager = new TopicManager();
    $topicManager->add([
        'topicName' => $topicName,
        'category_id' => $categoryId,
        'membre_id' => 1  // L'ID du membre est fixe pour le moment, pourrait être dynamique plus tard
    ]);

    // Rediriger vers la liste des topics de la catégorie
    $this->redirectTo("forum", "listTopicsByCategory", $categoryId);
} else {
    // Si les données sont manquantes, afficher un message d'erreur
    Session::addFlash('error', 'Le nom du topic est requis.');
    return $this->redirectTo("forum", "listCategories");
}
}
    
    
}