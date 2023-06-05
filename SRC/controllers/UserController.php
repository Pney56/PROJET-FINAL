<?php 

require_once 'SRC/Database.php';
require_once 'SRC/models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct(UserModel $userModel = null) {
        if ($userModel === null) {
            $userModel = new UserModel();
        }
        $this->userModel = $userModel;
    }

    public function login() {
        // code de connexion 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Récupération des données de formulaire soumises
            $email = Security::sanitize($_POST['email']);
            $password = ($_POST['password']);
    
            $row = $this->userModel->getUserByEmail($email);
            if ($row) {
                // Vérification du mot de passe
                if (password_verify($password, $row['mot_de_passe'])) {
                    // L'utilisateur est authentifié avec succès, créer une session pour l'utilisateur
                    
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['isAdmin'] = $this->userModel->isAdmin($row['username']); // Ajoutez cette ligne
                    $_SESSION['isLogged'] = true;

                    
                    // Redirection vers l'a page de l'API
                    header('Location: index.php?route=redirectToApi');
                    exit();
                } else {
                    // Le mot de passe est incorrect, afficher un message d'erreur
                    $errorMessage = "Mot de passe incorrect";
                }
            } else {
                // L'utilisateur n'existe pas, afficher un message d'erreur
                $errorMessage = "L'utilisateur n'existe pas";
            }
        }
    
        // Vérifier s'il y a un message d'erreur
        if (isset($errorMessage)) {
            // Stocker le message d'erreur dans la session
            session_start();
            $_SESSION['error_message'] = $errorMessage;
    
            // Rediriger l'utilisateur vers la page de connexion
            header('Location: ?route=accueil');
            exit();
        } else {
            // Afficher la page de connexion normalement
            $this->showLoginForm();
        }
    }
    
    
    public function register() {
        // Récupération des données de formulaire soumises
        $username = Security::sanitize($_POST['signup-username']);
        $password = ($_POST['signup-password']);
        $email = Security::sanitize($_POST['signup-email']);

        $row = $this->userModel->getUserByUsernameOrEmail($username, $email);
        if ($row) {
            $errorMessage = "L'adresse email ou le nom d'utilisateur est déjà utilisé.";
        } else {
            $this->userModel->createUser($username, $email, $password);
            // Redirection vers la page de connexion
            header('Location: ?route=accueil');
            exit();
        }
    }

   
    public function showLoginForm() {
        // Vérifier s'il y a un message d'erreur dans la session
        $errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;
            // require_once 'SRC/views/login_view.php';
    }
}
 