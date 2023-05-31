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

    public static function searchManga($query, $accessToken, $limit = 10, $id = null) {
        $ch = curl_init();
        $url = 'https://api.myanimelist.net/v2/manga';
        $queryParams = http_build_query([
            'q' => $query,
            'limit' => $limit,
            'fields' => 'id,title,main_picture,authors{first_name,last_name},synopsis',  // Ajoutez les champs ici pour avoir plus d'information
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
    

    public static function displaySearchResults($searchResults) {
        ob_start(); // Démarre la mise en tampon de sortie
        
        $results = ($searchResults ?? [])['data'] ?? [];
    
        if (empty($results)) {
            $randomQuery = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 10);
            $results = array_merge($results, ($additionalResults ?? [])['data'] ?? []);
        }
    
        include __DIR__ . '/../Views/manga_views.php';  // Inclut le fichier de vue contenant le code HTML
    
        $html = ob_get_clean(); // Récupère le contenu de la mise en tampon de sortie et nettoie la mise en tampon
    
        return $html;
    }
    
    public function displayAlternativeView($searchResults)
    {
    ob_start(); // Démarre la mise en tampon de sortie
    
    $results = ($searchResults ?? [])['data'] ?? [];

    if (empty($results)) {
        $randomQuery = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 10);
        $results = array_merge($results, ($additionalResults ?? [])['data'] ?? []);
    }

    include __DIR__ . '/../Views/manga_views_alt.php';  // Inclut le fichier de vue alternative contenant le code HTML

    $htmlprofil = ob_get_clean(); // Récupère le contenu de la mise en tampon de sortie et nettoie la mise en tampon

    return $htmlprofil;
    }

    
    
}

