<?php


require_once __dir__ . '/../models/UserModel.php';

class ProfileEditController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index() {
    
        // Récupération des informations actuelles de l'utilisateur
        $username = $_SESSION['username'];
        $userInfo = $this->userModel->getUserByUsername($username);
        $username = $userInfo['username'];
        $email = $userInfo['email'];
    
        // Inclure le fichier de vue Change_profil_views.php
        require_once __dir__ . '/../views/Change_profil_views.php';
    }
    
    // Suppresion de l'utilisateur

    public function deleteProfile() {
        $username = $_SESSION['username'];
        $this->userModel->deleteUserByUsername($username);

        session_destroy(); // Détruire la session
        header('Location: /PROJET-FINAL/login'); // Rediriger vers la page de connexion
        exit();
    }


    public function updateProfile() {


        // Initialisation des variables
        $username = $_SESSION['username'];
        $email = $password = $new_password = $confirm_new_password = "";

        // Vérification si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $new_password = $_POST['new_password'];
            $confirm_new_password = $_POST['confirm_new_password'];

            // Récupération des informations actuelles de l'utilisateur
            $userInfo = $this->userModel->getUserByUsername($username);
            $currentPasswordHash = $userInfo['mot_de_passe'];

            if ($userInfo && password_verify($password, $currentPasswordHash)) {
                // Vérification du nouveau mot de passe
                if (!empty($new_password) && $new_password === $confirm_new_password) {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                } else {
                    $password_hash = $currentPasswordHash;
                }

                // Mise à jour des informations de l'utilisateur
                $this->userModel->updateUser($username, $email, $password_hash);

                // Message de succès
                $_SESSION['message'] = "Profil mis à jour avec succès.";
                header('Location: /PROJET-FINAL/profil');
                exit();
            } else {
                // Message d'erreur
                $_SESSION['error'] = "Mot de passe incorrect.";
            }
        }

        // Récupération des informations actuelles de l'utilisateur
        $userInfo = $this->userModel->getUserByUsername($username);
        $username = $userInfo['username'];
        $email = $userInfo['email'];
    }
}
