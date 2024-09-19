<?php
// Include config and AuthModel
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/Model/AuthModel.php'; 

// Initialize AuthModel with PDO instance
$authModel = new AuthModel($pdo);

// Start session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}

// Retrieve user data from session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            width: 350px;
            padding: 20px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-top: 50px;
            border-radius: 5px;
            text-align: center;
        }
        .welcome-msg {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .logout {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2 class="welcome-msg">Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>You are now logged in.</p>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
