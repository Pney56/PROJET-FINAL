<?php

class LogoutController {


    public function index() {
        $this->logout();
    }
    
    public function logout() {
        session_destroy();
        header("Location: ?route=accueil");
        exit;
    }
}

