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
    
    if (!$topic) {
        Session::addFlash('error', 'Le topic spécifié n\'existe pas.');
        return $this->redirectTo('forum', 'listCategories');
    }
    
    // Récupérer les posts du topic
    $posts = $postManager->findPostsByTopic($id) ?? [];
    
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


    
    // CREER UN NOUVEAU TOPIC avec SON PREMIER POST
    public function createTopic() {
        if (!empty($_POST['topicName']) && !empty($_POST['postContent']) && !empty($_POST['category_id'])) {
            $topicName = filter_input(INPUT_POST, 'topicName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $postContent = filter_input(INPUT_POST, 'postContent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
            
            $topicManager = new TopicManager();
            $postManager = new PostManager();
    
            // Créer le topic et récupérer son ID
            $topicId = $topicManager->add([
                'topicName' => $topicName,
                'category_id' => $categoryId,
                'membre_id' => 1 // Remplace avec l'ID du membre connecté
            ]);
    
            if ($topicId) {
                // Insérer le post initial lié au topic créé
                $postManager->add([
                    'postContent' => $postContent,
                    'topic_id' => $topicId,
                    'membre_id' => 1,  // Remplace avec l'ID du membre connecté
                    'postDate' => (new \DateTime())->format('Y-m-d H:i:s')
                ]);
    
                $this->redirectTo("forum", "listPostsByTopic", $topicId);
            } else {
                Session::addFlash('error', 'Erreur lors de la création du topic.');
                $this->redirectTo("forum", "listTopicsByCategory", $categoryId);
            }
        } else {
            Session::addFlash('error', 'Tous les champs sont requis.');
            $this->redirectTo("forum", "listCategories");
        }
    }
    


    // créer un nouveau post
    public function createPost($topicId) {
        // Vérifier que le topic_id est valide (par exemple, vérifier s'il existe dans la base de données)
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($topicId); // Chercher un topic existant pour vérifier sa validité
    
        if (!$topic) {
            // Si le topic n'existe pas, afficher une erreur ou rediriger
            Session::addFlash('error', 'Le topic spécifié n\'existe pas.');
            $this->redirectTo('forum', 'index'); // Ou rediriger vers la page d'accueil ou autre
            return;
        }
    
        // Si on est ici, le topic existe et l'utilisateur est sur la page de création du post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $postContent = filter_input(INPUT_POST, 'postContent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $membreId = 1; // Exemple : ici, le membre est 1, il faudra récupérer l'ID du membre via la session plus tard
    
            // Si le contenu du post est vide, afficher une erreur
            if (empty($postContent)) {
                Session::addFlash('error', 'Le contenu du post ne peut pas être vide.');
                $this->redirectTo('forum', 'createPost', $topicId);
                return;
            }
    
            // Préparer les données du post
            $postData = [
                'postContent' => $postContent,
                'topic_id' => $topicId,
                'membre_id' => $membreId,
                'postDate' => (new \DateTime())->format('Y-m-d H:i:s')
            ];
    
            // Ajouter le post via le PostManager
            $postManager = new PostManager();
            $postManager->add($postData);
    
            // Rediriger vers la liste des posts du topic
            $this->redirectTo('forum', 'listPostsByTopic', $topicId);
        }
    
        // Si c'est un GET, afficher le formulaire de création du post
        return [
            "view" => VIEW_DIR."forum/listPosts.php",
            "meta_description" => "Créer un nouveau post pour le topic : ".$topic->getTopicName(),
            "data" => [
                "topic" => $topic,  // Transmettre l'objet topic à la vue
            ]
        ];
    }
    
    }


