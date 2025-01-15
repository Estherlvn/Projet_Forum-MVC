<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\MembreManager;
use App\Session;

class AdminController extends AbstractController implements ControllerInterface {

    public function index() {
        // // Vérifier si l'utilisateur a un rôle d'admin
        // $this->restrictTo('ROLE_ADMIN');  // Cette méthode peut vérifier si l'utilisateur est admin

        // Créer une instance du MembreManager
        $membreManager = new MembreManager();
        
        // Récupérer tous les membres (dans votre table 'membre')
        $membres = $membreManager->findAll(['registrationDate', 'DESC']); // Tri par date d'inscription
        
        var_dump($membres); // Vérifier si $membres contient bien des données

        return [
            "view" => VIEW_DIR . "admin/dashboard.php", // Vue pour l'admin
            "data" => [
                "membres" => $membres  // Passer les membres récupérés à la vue
            ],
            "meta_description" => "Tableau de bord de l'administration"
        ];
    }
}
