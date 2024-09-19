<?php
session_start();
require_once __DIR__ . '/../config/config.php'; 

// Only allow authenticated users to access this page, and ensure the user role is 'user'
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    header('Location: /login.php');  // Redirect to login if not authenticated
    exit;
}

// User dashboard content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="/assets/css/user.css">
</head>
<body>
    <h1>User Dashboard</h1>
    <p>Welcome, User! <a href="/logout.php">Logout</a></p>

    <!-- Add user-specific functionality here -->
</body>
</html>
