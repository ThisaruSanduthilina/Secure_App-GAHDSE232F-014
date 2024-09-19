<?php
// functions.php

/**
 * Check if the current user has a specific role.
 *
 * @param string $role The role to check against.
 * @return bool True if the user has the role, false otherwise.
 */
function hasRole($role) {
    // Ensure session is started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Check if the role is set in the session and matches the required role
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role;
}
?>
