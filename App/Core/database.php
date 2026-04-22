<?php

class Database
{
    private PDO $pdo;

    public function __construct(
        string $host = "localhost",
        string $db = "gamevault",
        string $user = "root",
        string $pass = "",
        string $charset = "utf8mb4"
    ) {
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            // Log, custom error page, fallback...
            die("Database connection failed: " . $e->getMessage());
        }
    }


    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
