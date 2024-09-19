<?php
/**
 * Role-Based Access Control (RBAC) configuration and helper functions
 */

// Roles and their corresponding permissions
$roles = [
    'admin' => [
        'manage_users',
        'view_users',
        'edit_users',
        'delete_users',
        'view_reports',
        'manage_permissions'
    ],
    'user' => [
        'view_profile',
        'edit_profile',
        'upload_files',
    ],
    'guest' => [
        'view_content',
        'register',
        'login',
    ]
];

/**
 * Check if the user has a specific role
 *
 * @param string $role
 * @return bool
 */
function hasRole($role)
{
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

/**
 * Check if the user has the necessary permission
 *
 * @param string $permission
 * @return bool
 */
function hasPermission($permission)
{
    global $roles;

    // Get the current user role from the session
    $role = $_SESSION['role'] ?? 'guest';

    // Check if the user's role has the required permission
    return in_array($permission, $roles[$role] ?? []);
}

/**
 * Protect a route by requiring a specific role
 *
 * @param string $role
 * @return void
 */
function requireRole($role)
{
    if (!hasRole($role)) {
        header('Location: /auth/login.php'); // Redirect to login if the user doesn't have the role
        exit;
    }
}

/**
 * Protect a route by requiring a specific permission
 *
 * @param string $permission
 * @return void
 */
function requirePermission($permission)
{
    if (!hasPermission($permission)) {
        header('HTTP/1.1 403 Forbidden');
        echo "403 Forbidden - You don't have permission to access this resource.";
        exit;
    }
}
