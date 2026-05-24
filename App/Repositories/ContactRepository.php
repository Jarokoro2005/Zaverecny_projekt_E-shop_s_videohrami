<?php

require_once __DIR__ . '/../Core/database.php';

class ContactRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function createContact(
        string $name,
        string $email,
        string $topic,
        string $message,
        int $newsletter
    ): bool {
        $sql = "INSERT INTO contact_messages (name, email, topic, message, newsletter)
                VALUES (:name, :email, :topic, :message, :newsletter)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':topic' => $topic,
            ':message' => $message,
            ':newsletter' => $newsletter,
        ]);
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM contact_messages ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM contact_messages WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function updateContact(
        int $id,
        string $name,
        string $email,
        string $topic,
        string $message,
        int $newsletter
    ): bool {
        $sql = "UPDATE contact_messages
                SET name = :name,
                    email = :email,
                    topic = :topic,
                    message = :message,
                    newsletter = :newsletter
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':email' => $email,
            ':topic' => $topic,
            ':message' => $message,
            ':newsletter' => $newsletter,
        ]);
    }

    public function deleteContact(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM contact_messages WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    public function updateSeen(int $id, int $seen): bool
    {
        $stmt = $this->pdo->prepare('UPDATE contact_messages SET seen = :seen WHERE id = :id');
        return $stmt->execute([
            ':id' => $id,
            ':seen' => $seen,
        ]);
    }
}
