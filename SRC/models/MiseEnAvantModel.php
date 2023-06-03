<?php

require_once 'SRC/Database.php';

class MiseEnAvantModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

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
