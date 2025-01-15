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

            // Ajouter l'utilisateur avec le rôle par défaut "user"
        $membreManager->add([
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'user'  // Attribuer le rôle "user" par défaut
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
                $membreManager = new MembreManager();
                $membre = $membreManager->findByPseudo($pseudo);
    
                if ($membre) {
                    // var_dump($membre); // Vérifiez si l'objet est bien récupéré
                    // // Vérifiez d'abord si le mot de passe est bien récupéré depuis la base de données
                    // var_dump($membre->getPassword());  // Vérifiez si le mot de passe est correctement récupéré
                    if ($membre->getPassword() && password_verify($password, $membre->getPassword())) {
                        // var_dump($membre->getPassword());
                        // var_dump(password_verify($password, $membre->getPassword()));
                        Session::setUser($membre);
                        header('Location: index.php?ctrl=forum&action=home');
                        exit();
                    } else {
                        Session::addFlash('error', 'Nom d\'utilisateur ou mot de passe incorrect');
                    }
                } else {
                    Session::addFlash('error', 'Nom d\'utilisateur ou mot de passe incorrect');
                }
            } else {
                Session::addFlash('error', 'Veuillez remplir tous les champs.');
            }
        }
    
            // Assurez-vous que vous retournez la bonne structure de données
            return [
                "view" => VIEW_DIR . "security/login.php",
                "meta_description" => "Connexion à votre compte"  // Assurez-vous que cette clé est présente
            ];
        }    


    // METHODE POUR LA DECONNEXION
    public function logout() {

        Session::setUser(null);
        Session::addFlash('success', 'Vous avez été déconnecté avec succès.');
        $this->redirectTo('security', 'login');
    }



    // VUE PROFILE

    // RESTREINDRE l'accès aux contributions du forum aux membres connectés
    protected function restrictToUser() {
        if (!Session::getUser()) {
            // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
            Session::addFlash('error', 'Vous devez être connecté pour accéder à cette page.');
            $this->redirectTo('security', 'login');
        }
    }


    // Méthode pour afficher le profil du membre connecté
    public function profile() {
        // Vérifier si l'utilisateur est connecté
        $this->restrictToUser();
    
        // Récupérer l'utilisateur connecté
        $user = Session::getUser();
    
        // Passer les informations de l'utilisateur à la vue
        return [
            "view" => VIEW_DIR . "security/profile.php",
            "data" => [
                "user" => $user // Envoyer l'objet utilisateur à la vue
            ],
            "meta_description" => "Profil de l'utilisateur"
        ];
    }

}