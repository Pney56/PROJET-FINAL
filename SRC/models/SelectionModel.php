<?php

require_once 'SRC/Database.php';

class SelectionModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }


}
