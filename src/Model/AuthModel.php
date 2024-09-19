<?php

class AuthModel {
    private $db;

    // Constructor receives a PDO instance
    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Login function: checks the username and password
    public function login($username, $password) {
        try {
            $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // If password is correct, return user data
                return $user;
            }

            return false; // If no user found or password is incorrect

        } catch (PDOException $e) {
            // Log error if needed
            return false;
        }
    }

    // Register a new user (optional, in case you want to add registration)
    public function register($username, $password, $role_id) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
            $sql = "INSERT INTO users (username, password, role_id, created_at) VALUES (:username, :password, :role_id, CURRENT_TIMESTAMP())";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error message
            error_log("Registration failed: " . $e->getMessage());
            return false;
        }
    }

    // Add this method in AuthModel.php
public function getUserRole($username) {
    try {
        $sql = "SELECT role_id FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $role = $stmt->fetchColumn();
        return $role;
    } catch (PDOException $e) {
        // Log error message
        error_log("Failed to fetch user role: " . $e->getMessage());
        return false;
    }
}

}
