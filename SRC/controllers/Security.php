<?php

class Security{

    /** Nettoyer les entrées des $_POST  */

    public static function sanitize($input) {

        // Supprime les balises HTML et PHP
        $input = strip_tags($input);
      
        // Convertit les caractères spéciaux en entités HTML
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
      
        return $input;
    }


    // /** Vérifier la validité d'un mot de passe */
    // public static function isPasswordValid($password) {
    //     // Vérifie si le mot de passe a au moins 8 caractères
    //     if (strlen($password) < 8) {
    //         return false;
    //     }
    
    //     // Vérifie si le mot de passe contient au moins une lettre majuscule
    //     if (!preg_match('/[A-Z]/', $password)) {
    //         return false;
    //     }
    
    //     // Vérifie si le mot de passe contient au moins une lettre minuscule
    //     if (!preg_match('/[a-z]/', $password)) {
    //         return false;
    //     }
    
    //     // Vérifie si le mot de passe contient au moins un chiffre
    //     if (!preg_match('/[0-9]/', $password)) {
    //         return false;
    //     }
    
    //     // Si toutes les vérifications passent, le mot de passe est valide
    //     return true;
    // }
    
}
