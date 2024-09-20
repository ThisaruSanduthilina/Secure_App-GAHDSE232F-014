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
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Unknown Email'; // Check if email is set
$role_id = isset($_SESSION['role_id']) ? $_SESSION['role_id'] : 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="./assets/admin.css">
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
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Role:</strong> <?php echo htmlspecialchars($role_id == 1 ? 'Admin' : 'User'); ?></p>
            
            <!-- Adding the "View Users" button under the profile box -->
            <a href="/SC_CW/src/view/admin/view_users.php" class="btn-view-users">View Users</a>
        </div>
    </section>

    <footer>
        <p>Contact us at: Thisrusanduthilina@gmail.com</p>
    </footer>
</body>
</html>
