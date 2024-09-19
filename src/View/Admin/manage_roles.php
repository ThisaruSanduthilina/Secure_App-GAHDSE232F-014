<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Roles</title>
    <link rel="stylesheet" href="/View/Admin/assets/admin.css">
</head>
<body>
    <h1>Manage Roles</h1>
    
    <!-- Table to show existing roles and users with each role -->
    <table>
        <thead>
            <tr>
                <th>Role ID</th>
                <th>Role Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Populate with roles from the database -->
            <?php foreach($roles as $role): ?>
            <tr>
                <td><?= $role['id']; ?></td>
                <td><?= $role['name']; ?></td>
                <td><?= $role['description']; ?></td>
                <td>
                    <a href="/admin/edit-role.php?id=<?= $role['id']; ?>">Edit</a>
                    <a href="/admin/delete-role.php?id=<?= $role['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Form to add a new role -->
    <h2>Add New Role</h2>
    <form action="/admin/add-role.php" method="POST">
        <label for="role_name">Role Name:</label>
        <input type="text" id="role_name" name="role_name" required>

        <label for="role_description">Role Description:</label>
        <input type="text" id="role_description" name="role_description" required>

        <button type="submit">Add Role</button>
    </form>

</body>
<script src="/View/Admin/assets/admin.js"></script>
</html>
