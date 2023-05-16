<?php

class Database {
    private static $instance = null;

    private function __construct() { }

    public static function getInstance() {
        if (self::$instance === null) {
            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_NAME'];
            $dbuser = $_ENV['DB_USER'];
            $dbpass = $_ENV['DB_PASSWORD'];
            try {
                self::$instance = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur : Impossible de se connecter à la base de données.");
            }
        }

        return self::$instance;
    }
}
