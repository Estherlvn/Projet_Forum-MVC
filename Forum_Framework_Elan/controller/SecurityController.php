<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\MembreManager;
use App\Session;

class SecurityController extends AbstractController {


    

    // METHODE POUR L'INSCRIPTION
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            if ($password !== $confirmPassword) {
                Session::addFlash('error', 'Les mots de passe ne correspondent pas.');
                $this->redirectTo('security', 'register');
                return;
            }
    
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $membreManager = new MembreManager();
            
            // Vérification que le pseudo et l'email ne sont pas déjà utilisés
            if ($membreManager->findByPseudo($pseudo)) {
                Session::addFlash('error', 'Ce pseudo est déjà pris.');
                $this->redirectTo('security', 'register');
                return;
            }
    
            if ($membreManager->findByEmail($email)) {
                Session::addFlash('error', 'Cet email est déjà utilisé.');
                $this->redirectTo('security', 'register');
                return;
            }

            // Ajouter l'utilisateur
            $membreManager->add([
                'pseudo' => $pseudo,
                'email' => $email,
                'password' => $hashedPassword
            ]);
    
            Session::addFlash('success', 'Inscription réussie !');
            $this->redirectTo('security', 'login');
        } else {
            return [
                "view" => VIEW_DIR . "security/register.php",
                "meta_description" => "Inscription sur le forum"
            ];
        }
    }
    


    // METHODE POUR LA CONNEXION
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            if ($pseudo && $password) {
                $membreManager = new \Model\Managers\MembreManager();
                $membre = $membreManager->findByPseudo($pseudo);
    
                if ($membre && password_verify($password, $membre->getPassword())) {
                    Session::setUser($membre);
                    header('Location: index.php?ctrl=forum&action=home');
                    exit();
                } else {
                    Session::addFlash('error', 'Nom d\'utilisateur ou mot de passe incorrect');
                }
            } else {
                Session::addFlash('error', 'Veuillez remplir tous les champs.');
            }
        }
    
        return [
            'view' => VIEW_DIR . 'security/login.php',
            'meta_description' => 'Connexion à votre compte'
        ];
    }


    // METHODE POUR LA DECONNEXION
    public function logout() {

        Session::setUser(null);
        Session::addFlash('success', 'Vous avez été déconnecté avec succès.');
        $this->redirectTo('security', 'login');
    }
}
