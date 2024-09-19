<?php
// Include necessary models and configuration files
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/model/UserModel.php';

class UserController
{
    private $userModel;
    private $encryptionKey;
    private $iv;

    public function __construct()
    {
        // Initialize the UserModel with PDO
        global $pdo;
        $this->userModel = new UserModel($pdo);

        // Load encryption key and IV from configuration
        $config = require __DIR__ . '/../config/config.php';
        $this->encryptionKey = $config['encryption_key'];
        $this->iv = $config['encryption_iv'];

        // Require the user to be authenticated
        $this->requireLogin();
    }

    // Require the user to be logged in
    private function requireLogin()
    {
        if (!hasRole('user')) {
            header('Location: /public/login.php');
            exit;
        }
    }

    // View user profile
    public function viewProfile($userId)
    {
        $user = $this->userModel->getUserById($userId);
        require_once __DIR__ . '/../Views/User/view_profile.php';
    }

    // Edit user profile
    public function editProfile($userId)
    {
        if (isset($_POST['update'])) {
            $updatedData = $_POST;

            // Encrypt sensitive fields before updating
            if (isset($updatedData['phone'])) {
                $updatedData['phone'] = openssl_encrypt($updatedData['phone'], 'aes-256-cbc', $this->encryptionKey, 0, $this->iv);
            }

            if (isset($updatedData['address'])) {
                $updatedData['address'] = openssl_encrypt($updatedData['address'], 'aes-256-cbc', $this->encryptionKey, 0, $this->iv);
            }

            // Update the profile with encrypted data
            $this->userModel->updateProfile($userId, $updatedData);
            header('Location: /user/view-profile.php');
        } else {
            $user = $this->userModel->getUserById($userId);
            require_once __DIR__ . '/../Views/User/edit_profile.php';
        }
    }

    // Handle file uploads (e.g., user profile picture)
    public function uploadFile($userId)
    {
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $this->userModel->uploadFile($userId, $file);
            header('Location: /user/view-profile.php');
        }
    }
}
