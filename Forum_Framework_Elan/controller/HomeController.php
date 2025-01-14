<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;

class HomeController extends AbstractController implements ControllerInterface {

    public function index() {
        $topicManager = new TopicManager();
        $topics = $topicManager->findAllTopics();
        
        return [
            "view" => VIEW_DIR . "home.php",
            "data" => [
                "topics" => $topics
            ],
            "meta_description" => "Bienvenue sur le forum"
        ];
    }
    
    public function users() {
        $this->restrictTo("ROLE_USER");

        $manager = new UserManager();
        $users = $manager->findAll(['registrationDate', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
    }
}
