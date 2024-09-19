<?php

class UserModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Example function to get user by ID
    public function getUserById($userId)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $userId]);
        return $stmt->fetch();
    }

    // Example function to update user profile
    public function updateProfile($userId, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
        return $stmt->execute(['name' => $data['name'], 'email' => $data['email'], 'id' => $userId]);
    }

    // Example function for file upload handling
    public function uploadFile($userId, $file)
    {
        // File upload logic here
    }
}
?>
