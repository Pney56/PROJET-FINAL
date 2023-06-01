<?php

require_once 'SRC/models/NoteModel.php';

class NoteController {
    private $noteModel;

    public function __construct() {
        $this->noteModel = new NoteModel();
    }

    public function getNotes($username) {
        return $this->noteModel->getNotes($username);
    }

    public function addNote($username, $apiId, $note) {
        return $this->noteModel->addNote($username, $apiId, $note);
    }

    public function updateNote($username, $noteId, $updatedNote) {
        return $this->noteModel->updateNote($username, $noteId, $updatedNote);
    }

    public function deleteNote($username, $noteId) {
        return $this->noteModel->deleteNote($username, $noteId);
    }
}
