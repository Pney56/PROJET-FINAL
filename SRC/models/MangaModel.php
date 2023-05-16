<?php

require_once 'SRC/Database.php';

class MangaModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function addMangaIfNotExists($api_id, $titre) {
        if (!$this->getMangaByApiId($api_id)) {
            $stmt = $this->db->prepare("INSERT INTO manga (api_id, titre) VALUES (?, ?)");
            $stmt->execute([$api_id, $titre]);
        }
    }

    public function addFavori($username, $api_id) {
        $stmt = $this->db->prepare("INSERT INTO Favori (username, api_id) VALUES (?, ?)");
        return $stmt->execute([$username, $api_id]);
    }
    
    public function removeFavori($username, $api_id) {
        $stmt = $this->db->prepare("DELETE FROM Favori WHERE username = ? AND api_id = ?");
        return $stmt->execute([$username, $api_id]);
    }
    

    public function getFavoriByUser($username) {
        $stmt = $this->db->prepare("SELECT Manga.api_id FROM Manga JOIN Favori ON Manga.api_id = Favori.api_id WHERE Favori.username = ?");
        $stmt->execute([$username]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    public function getFavoriMangas($username) {
        $stmt = $this->db->prepare("SELECT api_id FROM Favori WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    
    public function getMangaByApiId($api_id) {
        $stmt = $this->db->prepare("SELECT * FROM manga WHERE api_id = ?");
        $stmt->execute([$api_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
