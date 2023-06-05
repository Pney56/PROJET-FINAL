<?php


class MiseEnAvantController {

    public function index() {
        $mangaModel = new MangaModel();
        $mangaMisEnAvant = $mangaModel->getMangaMisEnAvantEnCours();
        
        // Si aucun manga n'est mis en avant, chargez la vue sans résultats.
        if (!$mangaMisEnAvant) {
            require_once __DIR__ . '/../views/mise_en_avant_views.php';
            return;  // Arrêtez ici pour ne pas exécuter le reste de la méthode.
        }
        
        // Vérifiez que vous avez un accessToken valide dans la session.
        if (!isset($_SESSION['access_token'])) {
            // Vous pouvez choisir de rediriger l'utilisateur vers une page d'erreur, 
            // ou lancer une exception, ou simplement retourner une valeur d'erreur.
            header('Location: ?route=accueil');
        }
        $accessToken = $_SESSION['access_token'];
    
        // Recherche le manga mis en avant à partir de l'API.
        $mangaMisEnAvantAPI = MangaController::getMangaById($mangaMisEnAvant['api_id'], $accessToken);
    
        // Crée un tableau de résultats contenant un seul élément.
        // Nous ajoutons une clé 'node' pour correspondre à la structure attendue par votre vue.
        $results = [['node' => $mangaMisEnAvantAPI]];
    
        require_once __DIR__ . '/../views/mise_en_avant_views.php';
    }
    
    

    public function adminIndex() {


        if (isset($_SESSION['username'])) {
            $mangaModel = new MangaModel();
            $mangas = $mangaModel->getMangasMisEnAvant();
            $mangaMisEnAvant = $mangaModel->getMangaMisEnAvantEnCours();

            require_once __dir__ . '/../views/admin_mise_en_avant_views.php';
        } else {
            header('Location: ?route=accueil');
            exit();
        }
    }

    public function setMiseEnAvant($api_id) {


        if (isset($_SESSION['username']) && $_SESSION['isAdmin']) {
            $mangaModel = new MangaModel();
            
            if ($mangaModel->isMangaMisEnAvant()) {
                // Afficher une alerte
                echo "<script>alert('Un manga est déjà mis en avant. Vous devez d'abord le retirer avant d'en mettre un autre en avant.');</script>";
            } else {
                // Mettre le manga en avant
                $mangaModel->setMangaMisEnAvant($api_id, true);
            }

            // Rediriger vers la page d'administration des mises en avant
            header('Location: ?route=admin_mise_en_avant');
            exit();
        } else {
            header('Location: ?route=accueil');
            exit();
        }
    }

    public function unsetMiseEnAvant() {


        if (isset($_SESSION['username']) && $_SESSION['isAdmin']) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $api_id = $_POST['manga_id'] ?? null;
                if ($api_id !== null) {
                    $mangaModel = new MangaModel();
                    $mangaModel->setMangaMisEnAvant($api_id, false);

                    // Rediriger vers la page d'administration des mises en avant
                    header('Location: ?route=admin_mise_en_avant');
                    exit();
                }
            }
        } else {
            header('Location: ?route=accueil');
            exit();
        }
    }

}
