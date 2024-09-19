<?php
// Start session and include required files
session_start();
require_once __DIR__ . '/../config/config.php'; // Adjust path if necessary
require_once __DIR__ . '/../functions.php'; // Ensure this includes session checks and encryption handling

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

// Retrieve user data (this should be passed from the controller)
$user = $this->userModel->getUserById($_SESSION['user_id']); // Replace with actual user data fetching

// Decrypt sensitive data
$encryptionKey = "your-secret-key"; // Ensure you securely store the key
$iv = "your-iv"; // Ensure the initialization vector is correctly used

$decryptedPhone = openssl_decrypt($user['phone'], 'aes-256-cbc', $encryptionKey, 0, $iv);
$decryptedAddress = openssl_decrypt($user['address'], 'aes-256-cbc', $encryptionKey, 0, $iv);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Profile</h2>
        <form method="POST" action="/user/edit-profile.php">
            <input type="hidden" name="update" value="1">

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($decryptedPhone); ?>" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?= htmlspecialchars($decryptedAddress); ?>" required>
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
