<?php

require_once __DIR__ . '/../Core/database.php';

class AdminUserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function getByUsername(string $username): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM admin_users WHERE username = :username');
        $stmt->execute([':username' => $username]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function createUser(string $username, string $password, string $role): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO admin_users (username, password_hash, role) VALUES (:username, :password_hash, :role)');
        return $stmt->execute([
            ':username' => $username,
            ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ':role' => $role,
        ]);
    }
}
