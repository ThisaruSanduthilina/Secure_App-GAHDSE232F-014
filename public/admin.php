<?php
session_start();
require_once __DIR__ . '/../config/config.php'; 

// Only allow admins to access this page
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: /index.php');
    exit;
}

// Admin dashboard content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, Admin! <a href="/logout.php">Logout</a></p>

    <!-- Add admin functionality here, like managing users or viewing logs -->
</body>
</html>
