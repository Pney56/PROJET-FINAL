<?php

require_once 'SRC/Database.php';

class SelectionModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function addSelection($api_id) {
        $stmt = $this->db->prepare("INSERT INTO selection (api_id) VALUES (?)");
        return $stmt->execute([$api_id]);
    }

    public function removeSelection($api_id) {
        $stmt = $this->db->prepare("DELETE FROM selection WHERE api_id = ?");
        return $stmt->execute([$api_id]);
    }

    public function getAllSelections() {
        $stmt = $this->db->prepare("SELECT api_id FROM selection");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }
}
