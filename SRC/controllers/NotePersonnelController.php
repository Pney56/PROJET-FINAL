<?php

require_once 'SRC/models/NoteModel.php';

class NoteController {
    private $noteModel;

    public function __construct() {
        $this->noteModel = new NoteModel();
    }

    public function getNotes($apiId) {
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $notes = $this->noteModel->getNotes($username, $apiId);
            echo json_encode($notes);
        }
        else {
            http_response_code(401);
            echo json_encode(["message" => "Unauthorized"]);
        }
    }

    public function addNote() {
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $apiId = $_POST['api_id'];
            $note = $_POST['note'];
            $result = $this->noteModel->addNote($username, $apiId, $note);
            echo json_encode(["success" => $result]);
        }
        else {
            http_response_code(401);
            echo json_encode(["message" => "Unauthorized"]);
        }
    }

    public function updateNote() {
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $noteId = $_POST['note_id'];
            $note = $_POST['note']; // Modification ici
            $result = $this->noteModel->updateNote($username, $noteId, $note); // Modification ici
            echo json_encode(["success" => $result]);
        }
        else {
            http_response_code(401);
            echo json_encode(["message" => "Unauthorized"]);
        }
    }
    
    public function deleteNote() {
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $noteId = $_POST['note_id'];
            $result = $this->noteModel->deleteNote($username, $noteId);
            echo json_encode(["success" => $result]);
        }
        else {
            http_response_code(401);
            echo json_encode(["message" => "Unauthorized"]);
        }
    }
}
