<?php
/**
 * Authentication settings and helper functions
 */

session_start(); // Start the session

// Load config settings
$config = include __DIR__ . '/config.php';
$dbConfig = $config['database'];

// Connect to the database
try {
    $pdo = new PDO("{$dbConfig['driver']}:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}", $dbConfig['username'], $dbConfig['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Authentication functions
class Auth
{
    private $pdo;
    private $config;

    public function __construct($pdo, $config)
    {
        $this->pdo = $pdo;
        $this->config = $config;
    }

    // Register a new user
    public function register($username, $password)
    {
        $hashedPassword = password_hash($password, $this->config['auth']['hash_algorithm']);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        return $stmt->execute([':username' => $username, ':password' => $hashedPassword]);
    }

    // Login a user
    public function login($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role']; // Assuming the user has a role
            return true;
        }

        return false;
    }

    // Check if the user is authenticated
    public function isAuthenticated()
    {
        return isset($_SESSION['user_id']);
    }

    // Get the authenticated user ID
    public function getUserId()
    {
        return $_SESSION['user_id'] ?? null;
    }

    // Logout the user
    public function logout()
    {
        session_destroy();
    }

    // Remember Me functionality (optional)
    public function rememberMe($userId)
    {
        $token = bin2hex(random_bytes(16));
        setcookie('remember_me', $token, time() + $this->config['auth']['remember_me_lifetime'], '/');
        $stmt = $this->pdo->prepare("UPDATE users SET remember_token = :token WHERE id = :id");
        $stmt->execute([':token' => $token, ':id' => $userId]);
    }

    // Verify Remember Me token
    public function verifyRememberMe()
    {
        if (isset($_COOKIE['remember_me'])) {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE remember_token = :token");
            $stmt->execute([':token' => $_COOKIE['remember_me']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                return true;
            }
        }

        return false;
    }

    // CSRF Token generation
    public function generateCsrfToken()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    // Verify CSRF token
    public function verifyCsrfToken($token)
    {
        return hash_equals($_SESSION['csrf_token'], $token);
    }
}

// Initialize the Auth class
$auth = new Auth($pdo, $config);
