<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\DAO;
use Model\Managers\MembreManager;
use Model\Managers\CategoryManager;
use App\Session;

class AdminController extends AbstractController implements ControllerInterface {

    public function dashboard() {
        // Vérifier si l'utilisateur a un rôle d'admin
        $this->restrictTo('ROLE_ADMIN');  // Cette méthode peut vérifier si l'utilisateur est admin

        // Créer une instance du MembreManager
        $membreManager = new MembreManager();
        
        // Récupérer tous les membres (dans votre table 'membre')
        $membres = $membreManager->findAll(['registrationDate', 'DESC']); // Tri par date d'inscription
        
        return [
            "view" => VIEW_DIR . "admin/dashboard.php", // Vue pour l'admin
            "data" => [
                "membres" => $membres  // Passer les membres récupérés à la vue
            ],
            "meta_description" => "Tableau de bord de l'administration"
        ];
    }

    public function deleteUser() {
        if (!Session::isAdmin()) {
            Session::addFlash('error', 'Action non autorisée.');
            header('Location: index.php?ctrl=security&action=login');
            exit();
        }

        $membreManager = new MembreManager();
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id && $membreManager->findOneById($id)) {
            $membreManager->delete($id);
            Session::addFlash('success', 'Utilisateur supprimé avec succès.');
        } else {
            Session::addFlash('error', 'Utilisateur introuvable.');
        }

        header('Location: index.php?ctrl=admin&action=dashboard');
        exit();
    }
}


