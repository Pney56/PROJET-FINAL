<?php 

class MangaController {


    public static function getMangaById($id, $accessToken) {
        $ch = curl_init();
        $url = 'https://api.myanimelist.net/v2/manga/' . $id;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        return json_decode($response, true);
    }

    

    // public static function searchManga($query, $accessToken, $limit = 10, $id = null) {
    //     $ch = curl_init();
    //     $url = 'https://api.myanimelist.net/v2/manga';
    //     $queryParams = http_build_query([
    //         'q' => $query,
    //         'limit' => $limit,
    //         'fields' => 'authors,synopsis',
    //         'id' => $id,
    //     ]);
        
    //     $urlWithParams = $url . '?' . $queryParams;
    //     curl_setopt($ch, CURLOPT_URL, $urlWithParams);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //         'Authorization: Bearer ' . $accessToken,
    //     ]);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     $response = curl_exec($ch);
    //     curl_close($ch);

    //     return json_decode($response, true);
    // }

    public static function searchManga($query, $accessToken, $limit = 10, $id = null) {
        $ch = curl_init();
        $url = 'https://api.myanimelist.net/v2/manga';
        $queryParams = http_build_query([
            'q' => $query,
            'limit' => $limit,
            'fields' => 'id,title,main_picture,authors{first_name,last_name},synopsis',  // Ajoutez les champs ici
            'id' => $id,
        ]);
        $urlWithParams = $url . '?' . $queryParams;
        curl_setopt($ch, CURLOPT_URL, $urlWithParams);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
    

    public static function displaySearchResults($searchResults, $isProfilePage = false) {
        $html = "<div class='manga-grid'>";
        $results = ($searchResults ?? [])['data'] ?? [];
        if (empty($results)) {
            $randomQuery = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 10);
            $results = array_merge($results, ($additionalResults ?? [])['data'] ?? []);
        }
        foreach ($results as $result) {
            $manga = $result['node'];
        
            // Variable -----------------------------------------------------------
            $title = htmlspecialchars($manga['title'] ?? "");
            $id = htmlspecialchars($manga['id'] ?? "");
            $imageUrl = $manga['main_picture']['medium'] ?? "default_image_url.jpg";
            $authors = implode(', ', array_map(function($author) {
                return $author['node']['first_name'] . ' ' . $author['node']['last_name'];
            }, $manga['authors'] ?? []));
            $synopsis = ($manga['synopsis'])  && !empty($manga['synopsis']) ? $manga['synopsis'] : "Aucun synopsis pour le moment";
            // Fin  Variable -----------------------------------------------------------    


       $html .= "<div class='manga-card'>";
       $html .= "<h3>$title</h3>";
       $html .= "<div class='manga-image'>";
       $html .= "<img src='$imageUrl' alt='$title'>";
       $html .= "<div class='manga-popup'>";
       $html .= "<h4 class='manga-author'>Auteur: $authors</h4>";
       $html .= "<p class='manga-synopsis main-manga-synopsis'>Synopsis: $synopsis</p>";
       $html .= "</div>";
       $html .= "</div>";
       $html .= "<div class='manga-buttons'>";
       if ($isProfilePage) {
           $html .= "<a href='index.php?route=removeFavori&id=$id' class='unfollow-button'>Retirer des favoris</a>";
       } else {
           $html .= "<a href='index.php?route=addFavori&id=$id' class='follow-button'>Ajouter aux favoris</a>";
       }
       $html .= "<a href='index.php?route=manga_details&id=$id' class='details-button'>Voir les détails</a>";
       $html .= "</div>";
       $html .= "</div>";
       

        }

        $html .= "</div>";
        return $html;
    }
    
    
    
}

