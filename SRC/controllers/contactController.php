<?php

class ContactController {
    public function index() {
        require_once 'SRC/views/contact_views.php';
    }

    public function handleFormSubmission() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $subject = $_POST['subject'] ?? '';
        $message = $_POST['message'] ?? '';

        // Valider les données et envoyer le courriel
        // ...

        // Rediriger vers la page de confirmation ou afficher un message d'erreur
        // ...
    }
}
