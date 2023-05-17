<?php

class ContactController {
    public function index() {
        require_once 'SRC/views/contact_views.php';
    }

    public function handleFormSubmission() {
        $name =  Security::sanitize($_POST['name'] ?? '');
        $email = Security::sanitize($_POST['email'] ?? '');
        $subject = Security::sanitize($_POST['subject'] ?? '');
        $message = Security::sanitize($_POST['message'] ?? '');

        // Valider les données et envoyer le courriel
        // ...

        // Rediriger vers la page de confirmation ou afficher un message d'erreur
        // ...
    }
}
