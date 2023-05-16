<?php


require_once 'config.php';


class ProfileController {
    
        private $mangaModel;
    
        public function __construct() {
            $this->mangaModel = new MangaModel();
        }
    
    
        public function index() {
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
