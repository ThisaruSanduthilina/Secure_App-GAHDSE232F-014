<?php

class AdminController
{
    private $adminModel;

    public function __construct()
    {
        // Load the Admin model for database queries
        $this->adminModel = new AdminModel();
        
        // Check if the user is an admin
        $this->requireAdmin();
    }

    // Require the user to be an admin
    private function requireAdmin()
    {
        if (!hasRole('admin')) {
            header('Location: /auth/login.php');
            exit;
        }
    }

    // Display list of all users
    public function viewUsers()
    {
        $users = $this->adminModel->getAllUsers();
        require_once '/app/Views/Admin/view_users.php';
    }

    // Edit user information
    public function editUser($userId)
    {
        if (isset($_POST['update'])) {
            $updatedData = $_POST;
            $this->adminModel->updateUser($userId, $updatedData);
            header('Location: /admin/view-users.php');
        } else {
            $user = $this->adminModel->getUserById($userId);
            require_once '/app/Views/Admin/edit_user.php';
        }
    }

    // Delete a user
    public function deleteUser($userId)
    {
        $this->adminModel->deleteUser($userId);
        header('Location: /admin/view-users.php');
    }
}
