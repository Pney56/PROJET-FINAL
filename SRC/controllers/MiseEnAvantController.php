<?php


class MiseEnAvantController {
    public function index() {
        // Récupérez les mangas mis en avant à partir de la base de données
        $mangas = /* Votre code pour récupérer les mangas mis en avant */

        include 'SRC/views/mise_en_avant_views.php';
    }



    public function adminIndex() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if (isset($_SESSION['username'])) {
            $accessToken = $_SESSION['access_token'];
            $mangaModel = new MangaModel();
            $favoriApiIds = $mangaModel->getFavoriByUser($_SESSION['username']);
            
            $favoriMangas = [];
            foreach ($favoriApiIds as $api_id) {
                $manga = MangaController::getMangaById($api_id, $accessToken);
                $favoriMangas[] = [
                    "node" => $manga
                ];
            }
            $htmlFavoriMangas = MangaController::displaySearchResults(["data" => $favoriMangas], true);
    
            require_once __dir__ . '/../views/profil_views.php';
        } else {
            header('Location: /PROJET-FINAL/login');
            exit();
        }
    }

}

