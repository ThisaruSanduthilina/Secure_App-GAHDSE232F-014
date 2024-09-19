<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Settings</title>
    <link rel="stylesheet" href="/View/User/assets/user.css">
</head>
<body>
    <h1>Settings</h1>
    <form action="/user/settings/update" method="POST">
        <label for="email">Update Email</label>
        <input type="email" id="email" name="email">
        <button type="submit">Update</button>
    </form>
</body>
<script src="/View/User/assets/user.js"></script>
</html>
