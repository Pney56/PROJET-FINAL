<?php 

// NotePersonnelController.php
require_once 'SRC/models/NotePersonnelModel.php';
require_once 'SRC/models/MangaModel.php';

class NotePersonnelController {
    private $notePersonnelModel;
    private $mangaModel;

    public function __construct() {
        $this->notePersonnelModel = new NotePersonnelModel();
        $this->mangaModel = new MangaModel();
    }

    public function addNote($username, $api_id, $note) {
        // Vérifie si le manga est en favoris avant d'ajouter une note
        if (in_array($api_id, $this->mangaModel->getFavoriMangas($username))) {
            return $this->notePersonnelModel->addNote($username, $api_id, $note);
        }
        return false;
    }

    public function updateNote($username, $api_id, $note) {
        // Vérifie si le manga est en favoris avant de mettre à jour la note
        if (in_array($api_id, $this->mangaModel->getFavoriMangas($username))) {
            return $this->notePersonnelModel->updateNote($username, $api_id, $note);
        }
        return false;
    }

    public function deleteNote($username, $api_id) {
        return $this->notePersonnelModel->deleteNote($username, $api_id);
    }

    public function getNote($username, $api_id) {
        return $this->notePersonnelModel->getNote($username, $api_id);
    }
}
