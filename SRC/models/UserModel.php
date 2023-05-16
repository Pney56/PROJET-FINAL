<?php

require_once 'SRC/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getUserByUsernameOrEmail($username, $email) {
        $query = "SELECT * FROM utilisateur WHERE username = :username OR email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM utilisateur WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($username, $email, $password) {
        $query = "INSERT INTO utilisateur (username, email, mot_de_passe) VALUES (:username, :email, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->execute();
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT username, email, mot_de_passe FROM utilisateur WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($username, $email, $password_hash) {
        $stmt = $this->db->prepare("UPDATE utilisateur SET username = :username, email = :email, mot_de_passe = :mot_de_passe WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $password_hash);
        $stmt->execute();
    }


    public function deleteUserByUsername($username) {
    $stmt = $this->db->prepare("DELETE FROM utilisateur WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    }

    public function checkIfUserIsAdmin($username) {
        $stmt = $this->db->prepare("SELECT isAdmin FROM utilisateur WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return isset($result['isAdmin']) && $result['isAdmin'] == 1;
    }
    
    public function isAdmin($username) {
        $stmt = $this->db->prepare("SELECT isAdmin FROM utilisateur WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return isset($result['isAdmin']) && $result['isAdmin'] == 1;
    }
    
    
    // Ajoutez d'autres méthodes pour interagir avec la base de données ( supprimer des utilisateurs, etc...)
}
