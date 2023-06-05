<?php

require_once 'MangaController.php';


class AccueilController {
    public function index($query = null) {
        if (isset($_SESSION['access_token'])) {
            $accessToken = $_SESSION['access_token'];

            if (!empty($query)) {
                $searchResults = MangaController::searchManga($query, $accessToken);
            } else {
                $randomQuery = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 10);
                $searchResults = MangaController::searchManga($randomQuery, $accessToken, 10);
            }

            $searchHtml = MangaController::displaySearchResults($searchResults);
        } else {
            $searchHtml = '<img src="Public/image/raiburari-attente.png" alt="Image attente" class="image-attente">';

        }

        require_once __DIR__ . '/../views/accueil_views.php';

    }
}



