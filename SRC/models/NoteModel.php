<?php

require_once 'SRC/Database.php';

class NoteModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getNotes($username) {
        $query = $this->db->prepare("SELECT * FROM note_personnel WHERE username = :username");
        $query->execute(['username' => $username]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNote($username, $apiId, $note) {
        $query = $this->db->prepare("INSERT INTO note_personnel (note, api_id, username) VALUES (:note, :api_id, :username)");
        $query->execute(['note' => $note, 'api_id' => $apiId, 'username' => $username]);
        return $query->rowCount();
    }

    public function updateNote($username, $noteId, $updatedNote) {
        $query = $this->db->prepare("UPDATE note_personnel SET note = :updated_note WHERE id_note = :note_id AND username = :username");
        $query->execute(['updated_note' => $updatedNote, 'note_id' => $noteId, 'username' => $username]);
        return $query->rowCount();
    }

    public function deleteNote($username, $noteId) {
        $query = $this->db->prepare("DELETE FROM note_personnel WHERE id_note = :note_id AND username = :username");
        $query->execute(['note_id' => $noteId, 'username' => $username]);
        return $query->rowCount();
    }
}
