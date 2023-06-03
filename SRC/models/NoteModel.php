<?php

require_once 'SRC/Database.php';

class NoteModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getNotes($username, $apiId) {
        $query = $this->db->prepare("SELECT * FROM note_personnel WHERE username = :username AND api_id = :api_id");
        $query->execute(['username' => $username, 'api_id' => $apiId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function addNote($username, $apiId, $note) {
        $query = $this->db->prepare("INSERT INTO note_personnel (note, api_id, username) VALUES (:note, :api_id, :username)");
        $query->execute(['note' => $note, 'api_id' => $apiId, 'username' => $username]);
        return $query->rowCount();
    }

    public function updateNote($username, $noteId, $note) { // Modification ici
        $query = $this->db->prepare("UPDATE note_personnel SET note = :note WHERE id_note = :note_id AND username = :username");
        $query->execute(['note' => $note, 'note_id' => $noteId, 'username' => $username]); // Modification ici
        return $query->rowCount();
    }

    public function deleteNote($username, $noteId) {
        $query = $this->db->prepare("DELETE FROM note_personnel WHERE id_note = :note_id AND username = :username");
        $query->execute(['note_id' => $noteId, 'username' => $username]);
        return $query->rowCount();
    }
}
