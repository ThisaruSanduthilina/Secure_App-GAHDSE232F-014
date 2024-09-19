<?php

class SecurityService
{
    /**
     * Hash a password using bcrypt.
     * 
     * @param string $password
     * @return string
     */
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Verify a hashed password.
     * 
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /**
     * Sanitize user input to prevent XSS and SQL injection.
     * 
     * @param string $data
     * @return string
     */
    public function sanitizeInput($data)
    {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Generate a secure token (e.g., for CSRF protection).
     * 
     * @param int $length
     * @return string
     */
    public function generateToken($length = 32)
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Encrypt sensitive data using AES-256-CBC.
     * 
     * @param string $data
     * @param string $key
     * @return string
     */
    public function encryptData($data, $key)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    /**
     * Decrypt encrypted data.
     * 
     * @param string $data
     * @param string $key
     * @return string
     */
    public function decryptData($data, $key)
    {
        list($encryptedData, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);
    }
}
