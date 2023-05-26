<?php

require_once 'config.php';

class MangaDetailsController {

    public function index($id) {

        // Récupération des détails du manga
        if (isset($_SESSION['access_token'])) {
            $accessToken = $_SESSION['access_token'];
            $mangaId = intval($id);
            $mangaDetails = $this->getMangaDetails($mangaId, $accessToken);
            $controller = $this;
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


    function displayMangaDetails($mangaDetails) {
        $title = $mangaDetails['title'];
        $imageUrl = $mangaDetails['main_picture']['large'];
        $synopsis = ($mangaDetails['synopsis'])  && !empty($mangaDetails['synopsis']) ? $mangaDetails['synopsis'] : "Aucun synopsis pour le moment";
        $status = $mangaDetails['status'];
        $startDate = $mangaDetails['start_date'];
        $endDate = isset($mangaDetails['end_date']) && !empty($mangaDetails['end_date']) ? $mangaDetails['end_date'] : "en cours de parution";
        $genres = $mangaDetails['genres'];
        $authors = $mangaDetails['authors'];
        $meanScore = isset($statistics['mean']) ? $statistics['mean'] : null;
        $rank = $mangaDetails['rank'];
        $numListUsers = $mangaDetails['num_list_users'];
        $popularity = $mangaDetails['popularity'];
        $numScoringUsers = $mangaDetails['num_scoring_users'];
        $alternativeTitles = $mangaDetails['alternative_titles'];
        $pictures = $mangaDetails['pictures'];
    
    ?>

        <h1 class='manga-title'><?= $title ?></h1>
        <div class="manga-details">
            <img src="<?= $imageUrl ?>" alt="<?= $title ?>" class="manga-image">
            <div class="manga-synopsis-container">
                <h2 class='manga-synopsis-title'>Synopsis</h2>
                <p class='manga-synopsis'><?= $synopsis ?></p>
            </div>
        </div>

        <div class="manga-info">
            <!-- Affiche les date et le status -->
            
            <h2 class="manga-date-title">Date:</h2>
            <p class='manga-status'>Status: <?= $status ?></p>
            <p class='manga-start-date'>Start date: <?= $startDate ?></p>

            <!-- Affiche la date de fin -->
            <?php if (!isset($mangaDetails['end_date']) || empty($endDate)) : ?>
            <p class='manga-end-date'>End date: en cours</p>
            <?php else : ?>
            <p class='manga-end-date'>End date: <?= $endDate ?></p>
            <?php endif; ?>
            
            <!-- Affichez les genres -->
            <h2 class='manga-genres-title'>Genres:</h2>
            <ul class='manga-genres-list'>
                <?php foreach ($genres as $genre) : ?>
                <li class='manga-genre'><?= $genre['name'] ?></li>
                <?php endforeach; ?>
            </ul>

            <!-- Affichez les auteurs -->
            <h2 class='manga-authors-title'>Authors:</h2>
            <ul class='manga-authors-list'>
                <?php foreach ($authors as $author) : ?>
                <li class='manga-author'>
                    <?= $author['node']['first_name'] ?> (<?= $author['role'] ?>)
                </li>
                <li class='manga-author'>
                    <?= $author['node']['last_name'] ?> (<?= $author['role'] ?>)
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Affichez les images supplémentaires -->
        <h2 class='manga-additional-images-title'>Additional images:</h2>
        <div class='manga-additional-images'>
            <?php foreach ($pictures as $picture) : ?>
            <?php $pictureUrl = $picture['large'] ?>
            <img src='<?= $pictureUrl ?>' alt='Additional image'>
            <?php endforeach ?>
        </div>

    <?php
            
    }
}