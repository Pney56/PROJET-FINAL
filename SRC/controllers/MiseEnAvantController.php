<?php

class MiseEnAvantController {
    public function index() {
        // Récupérez les mangas mis en avant à partir de la base de données
        $mangas = /* Votre code pour récupérer les mangas mis en avant */

        include 'SRC/views/mise_en_avant_views.php';
    }

    public function adminIndex() {
        include 'SRC/views/admin_mise_en_avant_views.php';
    }
}
