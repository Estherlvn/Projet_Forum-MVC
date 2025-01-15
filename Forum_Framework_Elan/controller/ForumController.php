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


    // RESTREINDRE l'accès aux contributions du forum aux membres connectés
    protected function restrictToUser() {
        if (!Session::getUser()) {
            // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
            Session::addFlash('error', 'Vous devez être connecté pour accéder à cette page.');
            $this->redirectTo('security', 'login');
        }
    }
    

    
    // CREER UN NOUVEAU TOPIC avec SON PREMIER POST
    public function createTopic() {
        
        // Vérifier si l'utilisateur est connecté pour créer un topic
        $this->restrictToUser();

        if (!empty($_POST['topicName']) && !empty($_POST['postContent']) && !empty($_POST['category_id'])) {
            $topicName = filter_input(INPUT_POST, 'topicName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $postContent = filter_input(INPUT_POST, 'postContent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
            
            // Récupérer l'utilisateur connecté
        $membre = Session::getUser();

        if ($membre && $categoryId && $topicName && $postContent) {
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            // Créer le topic et récupérer son ID
            $topicId = $topicManager->add([
                'topicName' => $topicName,
                'category_id' => $categoryId,
                'membre_id' => $membre->getId()  // Utilisation de l'ID du membre connecté
            ]);

            if ($topicId) {
                // Insérer le post initial lié au topic créé
                $postManager->add([
                    'postContent' => $postContent,
                    'topic_id' => $topicId,
                    'membre_id' => $membre->getId(),  // Utilisation de l'ID du membre connecté
                    'postDate' => (new \DateTime())->format('Y-m-d H:i:s')
                ]);

                $this->redirectTo("forum", "listPostsByTopic", $topicId);
            } else {
                Session::addFlash('error', 'Erreur lors de la création du topic.');
                $this->redirectTo("forum", "listTopicsByCategory", $categoryId);
            }
        } else {
            Session::addFlash('error', 'Données invalides.');
            $this->redirectTo("forum", "listCategories");
        }
    } else {
        Session::addFlash('error', 'Tous les champs sont requis.');
        $this->redirectTo("forum", "listCategories");
    }
}
    
    // CREER UN NOUVEAU POST dans un Topic
    public function createPost() {

         // Vérifier si l'utilisateur est connecté pour créer un post
         $this->restrictToUser();

        if (!empty($_POST['postContent']) && !empty($_POST['topic_id'])) {
            $postContent = filter_input(INPUT_POST, 'postContent', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $topicId = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);
            
            // Récupérer l'ID du membre connecté (ajusté avec la session)
            $membre = Session::getUser();
    
            if ($membre && $topicId && $postContent) {
                $postManager = new PostManager();
                $postManager->add([
                    'postContent' => $postContent,
                    'topic_id' => $topicId,
                    'membre_id' => $membre->getId(),  // Utiliser getId() pour récupérer l'ID
                    'postDate' => (new \DateTime())->format('Y-m-d H:i:s')
                ]);
    
                // Redirection vers le topic après la création du post
                $this->redirectTo('forum', 'listPostsByTopic', $topicId);
            } else {
                Session::addFlash('error', 'Données invalides. Impossible de créer le post.');
                $this->redirectTo('forum', 'listPostsByTopic', $topicId);
            }
        } else {
            Session::addFlash('error', 'Le contenu du post est requis.');
            $this->redirectTo('forum', 'listPostsByTopic', $_POST['topic_id']);
        }
    }
    
    
}


