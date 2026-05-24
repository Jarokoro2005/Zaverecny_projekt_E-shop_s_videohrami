<?php

class Database
{
    private PDO $pdo;

    public function __construct(array $dbConfig = [])
    {
        if (empty($dbConfig)) {
            $config = require __DIR__ . '/../../config/config.php';
            $dbConfig = $config['db'] ?? [];
        }

        $host = $dbConfig['host'] ?? 'localhost';
        $db = $dbConfig['name'] ?? 'gamevault';
        $user = $dbConfig['user'] ?? 'root';
        $pass = $dbConfig['pass'] ?? '';
        $charset = $dbConfig['charset'] ?? 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
