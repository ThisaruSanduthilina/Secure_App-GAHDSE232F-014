<?php

class AuthController
{
    private $authService;

    public function __construct()
    {
        // Load the Auth service for handling authentication
        $this->authService = new AuthService();
    }

    // Login functionality
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Authenticate the user
            if ($this->authService->login($email, $password)) {
                header('Location: /user/dashboard.php');
            } else {
                $error = "Invalid email or password";
                require_once '/app/Views/Auth/login.php';
            }
        } else {
            require_once '/app/Views/Auth/login.php';
        }
    }

    // Registration functionality
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userData = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];

            if ($this->authService->register($userData)) {
                header('Location: /auth/login.php');
            } else {
                $error = "Registration failed. Please try again.";
                require_once '/app/Views/Auth/register.php';
            }
        } else {
            require_once '/app/Views/Auth/register.php';
        }
    }

    // Logout functionality
    public function logout()
    {
        $this->authService->logout();
        header('Location: /auth/login.php');
    }
}
