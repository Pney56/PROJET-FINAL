<?php 

// NotePersonnelModel.php
class NotePersonnelModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function addNote($username, $api_id, $note) {
        $stmt = $this->db->prepare("INSERT INTO note_personnel (username, api_id, note) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $api_id, $note]);
    }

    public function updateNote($username, $api_id, $note) {
        $stmt = $this->db->prepare("UPDATE note_personnel SET note = ? WHERE username = ? AND api_id = ?");
        return $stmt->execute([$note, $username, $api_id]);
    }

    public function deleteNote($username, $api_id) {
        $stmt = $this->db->prepare("DELETE FROM note_personnel WHERE username = ? AND api_id = ?");
        return $stmt->execute([$username, $api_id]);
    }

    public function getNote($username, $api_id) {
        $stmt = $this->db->prepare("SELECT * FROM note_personnel WHERE username = ? AND api_id = ?");
        $stmt->execute([$username, $api_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}



