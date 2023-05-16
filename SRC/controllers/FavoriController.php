<?php 

require_once 'SRC/models/MangaModel.php';

class FavoriController {
    private $mangaModel;

    public function __construct() {
        $this->mangaModel = new MangaModel();
    }


    public function addFavori($username, $api_id) {
        $mangaTitle = $this->getMangaTitle($api_id, $_SESSION['access_token']);
        $this->mangaModel->addMangaIfNotExists($api_id, $mangaTitle);
        return $this->mangaModel->addFavori($username, $api_id);
    }


    public function getMangaTitle($mangaId, $accessToken) {
        $ch = curl_init();
        $url = "https://api.myanimelist.net/v2/manga/$mangaId";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        return $data['title'];
    }
    
    public function removeFavori($username, $api_id) {
        return $this->mangaModel->removeFavori($username, $api_id);
    }

    public function FavoriRequest() {
        session_start();
        if (isset($_POST['action'], $_POST['manga_id']) && isset($_SESSION['username'])) {
            $action = $_POST['action'];
            $mangaId = $_POST['manga_id'];
            $username = $_SESSION['username'];
    
            if ($action === 'add') {
                if ($this->addFavori($username, $mangaId)) {
                    echo json_encode(array('success' => true, 'url' => 'profil'));
                } else {
                    echo json_encode(array('success' => false));
                }
            } 
        }
    }
   
}
