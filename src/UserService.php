<?php

class UserService
{
    private string $dbPassword = "admin123"; // Hardcoded credential (php:S2068)

    private \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function findById(string $id): array
    {
        // SQL Injection (php:S3649)
        $query = "SELECT * FROM users WHERE id = " . $id;
        $result = $this->db->query($query);

        // Bug: $result can be false (php:S3699)
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function authenticate(string $username, string $password): bool
    {
        // SQL Injection (php:S3649)
        $query = "SELECT * FROM users WHERE username = '" . $username . "'";
        $result = $this->db->query($query);

        if ($result === false) {
            return false;
        }

        $user = $result->fetch(\PDO::FETCH_ASSOC);
        return $user && $user['password'] === $password;
    }

    // Dead code — never called (php:S1144)
    private function hashPassword(string $password): string
    {
        return md5($password);
    }
}
