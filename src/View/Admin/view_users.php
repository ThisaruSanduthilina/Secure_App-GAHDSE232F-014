<?php
session_start(); // Ensure this is at the top of the file

error_log('Session username: ' . (isset($_SESSION['username']) ? $_SESSION['username'] : 'Not set'));
error_log('Session role: ' . (isset($_SESSION['role']) ? $_SESSION['role'] : 'Not set'));



// Include config and AuthModel
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../src/Model/AuthModel.php'; 

// Initialize AuthModel with PDO instance
$authModel = new AuthModel($pdo);

// Check if the user is logged in and is an admin, otherwise redirect to login page
if (!isset($_SESSION['username']) || $_SESSION['role'] != 1) {
    error_log('Redirecting to login.php because the user is not logged in or not an admin.');
    header("Location: /SC_CW/public/login.php"); // Adjust path as needed
    exit();
}

// Retrieve users from the database
$users = [];
try {
    $sql = "SELECT id, username, role_id FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Failed to retrieve users: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-top: 50px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            margin-bottom: 20px;
        }
        .back {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2 class="header">View Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role ID</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['role_id']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="admindashboard.php" class="back">Back to Dashboard</a>
    </div>
</body>
</html>
