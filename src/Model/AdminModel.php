<?php

class AdminModel
{
    private $db;

    public function __construct()
    {
        // Initialize the database connection
        $this->db = Database::getConnection();
    }

    // Get all users from the database
    public function getAllUsers()
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE role = 'user'");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get user details by user ID
    public function getUserById($userId)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindParam(':id', $userId);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Update user information
    public function updateUser($userId, $updatedData)
    {
        $query = $this->db->prepare("UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id");
        $query->bindParam(':name', $updatedData['name']);
        $query->bindParam(':email', $updatedData['email']);
        $query->bindParam(':role', $updatedData['role']);
        $query->bindParam(':id', $userId);
        return $query->execute();
    }

    // Delete a user by user ID
    public function deleteUser($userId)
    {
        $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $query->bindParam(':id', $userId);
        return $query->execute();
    }

    // Promote a user to admin
    public function promoteToAdmin($userId)
    {
        $query = $this->db->prepare("UPDATE users SET role = 'admin' WHERE id = :id");
        $query->bindParam(':id', $userId);
        return $query->execute();
    }
}
