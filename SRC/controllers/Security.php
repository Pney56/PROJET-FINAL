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



    
}
