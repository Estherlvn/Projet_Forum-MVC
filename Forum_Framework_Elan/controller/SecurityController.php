<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use model\managers\MembreManager;
use App\Session;

class SecurityController extends AbstractController{

    // contiendra les méthodes liées à l'authentification : register, login et logout

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
            
            $membreManager->add([
                'pseudo' => $pseudo,
                'email' => $email,
                'password' => $hashedPassword
            ]);
    
            Session::addFlash('success', 'Inscription réussie !');
            $this->redirectTo('security', 'login');
        } else {
            return [
                "view" => VIEW_DIR."security/register.php",
                "meta_description" => "Inscription sur le forum"
            ];
        }
    }
    

    public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $membreManager = new MembreManager();

        if ($membre && password_verify($password, $membre->getPassword())) {
            Session::set('user', $membre);
            Session::addFlash('success', 'Connexion réussie !');
            $this->redirectTo('forum', 'index');
        } else {
            Session::addFlash('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
            $this->redirectTo('security', 'login');
        }
    } else {
        return [
            "view" => VIEW_DIR."security/login.php",
            "meta_description" => "Connexion au forum"
        ];
    }
}


    public function logout () {}

}