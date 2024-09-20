<?php
require_once __DIR__ . '/../config/config.php';

class UserModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Get user by ID
    public function getUserById($userId)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $userId]);
        return $stmt->fetch();
    }

    // Update user profile
    public function updateProfile($userId, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
        return $stmt->execute(['name' => $data['name'], 'email' => $data['email'], 'id' => $userId]);
    }

    // File upload handling
    public function uploadFile($userId, $file)
    {
        // File upload logic here
    }

    // Get all registered users
    public function getAllUsers()
    {
        $stmt = $this->pdo->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
