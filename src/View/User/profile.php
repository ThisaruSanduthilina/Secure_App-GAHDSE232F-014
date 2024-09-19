<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="/View/User/assets/user.css">
</head>
<body>
    <h1>Your Profile</h1>

    <?php if (isset($user)) : ?>
        <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p>Phone: <?php echo htmlspecialchars($user['phone']); ?></p>
        <p>Address: <?php echo htmlspecialchars($user['address']); ?></p>
    <?php else : ?>
        <p>Error: User data not found.</p>
    <?php endif; ?>

    <button type="button" onclick="window.location.href='/user/edit_profile.php';">Update</button>
</body>
<script src="/View/User/assets/user.js"></script>
</html>
