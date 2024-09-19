<?php

try {
    $pdo = new PDO('mysql:host=localhost:4306;dbname=SC_CW', 'root', '12345');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Database configuration
return [
    'database' => [
        'host' => 'localhost:4306',        // Database host
        'dbname' => 'SC_CW',  // Database name
        'username' => 'root',         // Database username
        'password' => '12345',             // Database password
        'charset' => 'utf8mb4',       // Character set
        'driver' => 'mysql',          // Database driver (mysql, pgsql, etc.)
    ],

    // Application settings
    'app' => [
        'base_url' => 'http://localhost/SC_CW',  // Base URL of the app
        'debug' => true,                               // Enable or disable debug mode
        'timezone' => 'UTC',                           // Default timezone
    ],

    // Authentication settings
    'auth' => [
        'session_lifetime' => 3600,                    // Session timeout in seconds (1 hour)
        'remember_me_lifetime' => 604800,              // "Remember Me" cookie lifetime (1 week)
        'hash_algorithm' => PASSWORD_BCRYPT,           // Hashing algorithm for passwords
        'token_lifetime' => 7200,                      // Token expiration time (2 hours)
    ],

    // Role-Based Access Control (RBAC) settings
    'rbac' => [
        'roles' => ['admin', 'user', 'guest'],         // Define roles
        'default_role' => 'guest',                     // Default role for new users
    ],

    // Logging settings
    'logging' => [
        'log_file' => __DIR__ . '/../logs/security.log',  // Path to the security log file
        'log_level' => 'error',                         // Log level: info, warning, error
    ],

    // Security settings
    'security' => [
        'encryption_key' => 'bin2hex(random_bytes(32))',  // Encryption key for secure data
        'csrf_protection' => true,                       // Enable CSRF protection
        'csrf_token_lifetime' => 3600,                   // CSRF token expiration time (1 hour)
    ],
];
