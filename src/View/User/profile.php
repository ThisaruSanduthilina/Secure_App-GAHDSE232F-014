<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if user is not logged in
    header("location: login.php");
    exit;
}

// Retrieve user data from the session
$username = $_SESSION['username'];
$email = $_SESSION['email']; // Fetch the email from the session
$role_id = isset($_SESSION['role_id']) ? $_SESSION['role_id'] : 'User';




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="./assets/user.css"> 
</head>
<body>
    <header>
        <div class="container">
            <h1>Welcome to Your Profile</h1>
        </div>
        <nav>
            <ul>
                <li><a href="/SC_CW/public/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <div class="profile">
            <h2>Your Profile Information</h2>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p> <!-- Displaying the email from session -->
            <p><strong>Role:</strong> <?php echo htmlspecialchars($role_id == 1 ? 'Admin' : 'User'); ?></p>
        </div>
    </section>

    <footer>
        <p>Contact us at: Thisrusanduthilina@gmail.com</p>
    </footer>
</body>
</html>
