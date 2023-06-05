<?php

require_once 'config.php';
require_once 'SRC/models/MangaModel.php';

class MangaDetailsController {
    public function index($id) {
        // Récupération des détails du manga
        if (isset($_SESSION['access_token'])) {
            $accessToken = $_SESSION['access_token'];
            $mangaId = intval($id);
            $mangaDetails = $this->getMangaDetails($mangaId, $accessToken);
            $data = $this->displayMangaDetails($mangaDetails); // Stocke les données dans une variable

            $mangaModel = new MangaModel();
            $isMangaMisEnAvant = $mangaModel->isMangaMisEnAvant();
            
            // Vérifier si l'utilisateur suit le manga
            $username = $_SESSION['username'];
            $isMangaFavori = $mangaModel->isMangaFavori($username, $mangaId);
            
            // Passer les données à la vue
            require_once __dir__ . '/../views/manga_details_views.php';
        } else {
            echo "Access token not found. Please complete the authorization process first.";
        }
    }


    private function getMangaDetails($id, $accessToken){
        $url = "https://api.myanimelist.net/v2/manga/" . $id . "?fields=id,title,main_picture,alternative_titles,start_date,end_date,synopsis,mean,rank,popularity,num_list_users,num_scoring_users,nsfw,created_at,updated_at,media_type,status,genres,my_list_status,num_volumes,num_chapters,authors{first_name,last_name},pictures";
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . $accessToken
        ));

        $response = curl_exec($curl);
        curl_close($curl);


        $mangaDetails = json_decode($response, true);
        return $mangaDetails;
    }


    private function displayMangaDetails($mangaDetails) {
        $title = $mangaDetails['title'];
        $imageUrl = $mangaDetails['main_picture']['large'];
        $synopsis = ($mangaDetails['synopsis']) && !empty($mangaDetails['synopsis']) ? $mangaDetails['synopsis'] : "Aucun synopsis pour le moment";
        $status = $mangaDetails['status'];
        $startDate = $mangaDetails['start_date'];
        $endDate = isset($mangaDetails['end_date']) && !empty($mangaDetails['end_date']) ? $mangaDetails['end_date'] : "en cours de parution";
        $genres = $mangaDetails['genres'];
        $authors = $mangaDetails['authors'];
        $meanScore = isset($mangaDetails['statistics']['mean']) ? $mangaDetails['statistics']['mean'] : null;
        $rank = $mangaDetails['rank'];
        $numListUsers = $mangaDetails['num_list_users'];
        $popularity = $mangaDetails['popularity'];
        $numScoringUsers = $mangaDetails['num_scoring_users'];
        $alternativeTitles = $mangaDetails['alternative_titles'];
        $pictures = $mangaDetails['pictures'];

        // Retourne les données nécessaires pour la vue
        return [
            'title' => $title,
            'imageUrl' => $imageUrl,
            'synopsis' => $synopsis,
            'status' => $status,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'genres' => $genres,
            'authors' => $authors,
            'meanScore' => $meanScore,
            'rank' => $rank,
            'numListUsers' => $numListUsers,
            'popularity' => $popularity,
            'numScoringUsers' => $numScoringUsers,
            'alternativeTitles' => $alternativeTitles,
            'pictures' => $pictures
        ];
    }
}