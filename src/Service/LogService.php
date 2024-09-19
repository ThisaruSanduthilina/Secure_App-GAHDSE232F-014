<?php

class LogService
{
    private $logFile;

    public function __construct($logFile = __DIR__ . '/../logs/security.log')
    {
        // Define the log file where security events are recorded.
        $this->logFile = $logFile;
    }

    /**
     * Log a security event.
     * 
     * @param string $event
     * @param string|null $userId
     * @return void
     */
    public function logEvent($event, $userId = null)
    {
        $date = date('Y-m-d H:i:s');
        $logMessage = "[{$date}] Event: {$event}";

        if ($userId) {
            $logMessage .= " | User ID: {$userId}";
        }

        $this->writeLog($logMessage);
    }

    /**
     * Log a failed login attempt.
     * 
     * @param string $username
     * @return void
     */
    public function logFailedLogin($username)
    {
        $this->logEvent("Failed login attempt for username: {$username}");
    }

    /**
     * Log a successful login attempt.
     * 
     * @param string $username
     * @return void
     */
    public function logSuccessfulLogin($username)
    {
        $this->logEvent("Successful login for username: {$username}");
    }

    /**
     * Log access denial.
     * 
     * @param string $username
     * @return void
     */
    public function logAccessDenied($username)
    {
        $this->logEvent("Access denied for username: {$username}");
    }

    /**
     * Write the log message to the log file.
     * 
     * @param string $message
     * @return void
     */
    private function writeLog($message)
    {
        file_put_contents($this->logFile, $message . PHP_EOL, FILE_APPEND);
    }
}
