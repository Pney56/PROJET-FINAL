<?php

class LogoutController {


    public function index() {
        $this->logout();
    }
    
    public function logout() {
        session_start();
        session_destroy();
        header("Location: accueil");
        exit;
    }
}

