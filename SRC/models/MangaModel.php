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
        $stmt = $this->db->prepare("SELECT manga.api_id FROM manga JOIN favori ON manga.api_id = favori.api_id WHERE favori.username = ?");
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
    
// mise en avant des manga 

    public function getMangasMisEnAvant() {
        $query = $this->db->prepare("SELECT * FROM manga WHERE isSelected = 0");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getMangaMisEnAvantEnCours() {
        $query = $this->db->prepare("SELECT * FROM manga WHERE isSelected = 1");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    

    public function setMangaMisEnAvant($mangaId, $isSelected) {
        $query = $this->db->prepare("UPDATE manga SET isSelected = :isSelected WHERE api_id = :mangaId");
        $query->execute(['isSelected' => $isSelected, 'mangaId' => $mangaId]);
        return $query->rowCount();
    }

    public function isMangaMisEnAvant() {
        $query = $this->db->prepare("SELECT COUNT(*) FROM manga WHERE isSelected = 1");
        $query->execute();
        return $query->fetchColumn() > 0;
    }
}
