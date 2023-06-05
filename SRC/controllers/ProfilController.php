<?php


require_once 'config.php';


class ProfileController {
    
        private $mangaModel;
    
        public function __construct() {
            $this->mangaModel = new MangaModel();
        }
    
    
        public function index()
        {
        
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
                
                // Créez une instance du contrôleur MangaController
                $mangaController = new MangaController();
                
                // Générer le contenu HTML de la nouvelle vue alternative des mangas favoris
                $htmlFavoriMangas = $mangaController->displayAlternativeView(["data" => $favoriMangas]);

        
                require_once __DIR__ . '/../views/profil_views.php';
            } else {
                header('Location: /PROJET-FINAL/login');
                exit();
            }
        }
}
