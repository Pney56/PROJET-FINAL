<?php


class MiseEnAvantController {

    public function index() {
        $mangaModel = new MangaModel();
        $mangaMisEnAvant = $mangaModel->getMangaMisEnAvantEnCours();

        include 'SRC/views/mise_en_avant_views.php';
    }

    public function adminIndex() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

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
