<?php 

// NotePersonnelModel.php
class NoteModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getNote($username, $mangaId) {
        $query = $this->pdo->prepare("SELECT note FROM notes WHERE username = :username AND manga_id = :manga_id");
        $query->execute(['username' => $username, 'manga_id' => $mangaId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['note'] : null;
    }

    public function updateNote($username, $mangaId, $note) {
        $query = $this->pdo->prepare("INSERT INTO notes (username, manga_id, note) VALUES (:username, :manga_id, :note) ON DUPLICATE KEY UPDATE note = :note");
        $query->execute(['username' => $username, 'manga_id' => $mangaId, 'note' => $note]);
        return $query->rowCount();
    }

    public function createNote($username, $mangaId, $note) {
        $db = $this->dbConnect();
        $sql = 'INSERT INTO notes (username, mangaId, note) VALUES (?, ?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->execute([$username, $mangaId, $note]);
    }
    
}
