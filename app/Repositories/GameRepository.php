<?php

require_once __DIR__ . '/../Core/database.php';

class GameRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function getGenres(): array
    {
        $stmt = $this->pdo->query(
            'SELECT genre, COUNT(*) AS game_count
             FROM games
             GROUP BY genre
             ORDER BY genre'
        );

        return $stmt->fetchAll();
    }

    public function getGames(array $filters = []): array
    {
        $params = [];
        $where = $this->buildWhere($filters, $params);

        $sql = "SELECT *
                FROM games
                $where
                ORDER BY is_featured DESC, rating DESC, title ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function countGames(array $filters = []): int
    {
        $params = [];
        $where = $this->buildWhere($filters, $params);

        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM games $where");
        $stmt->execute($params);

        return (int) $stmt->fetchColumn();
    }

    public function getBySlug(string $slug): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM games WHERE slug = :slug LIMIT 1');
        $stmt->execute([':slug' => $slug]);
        $game = $stmt->fetch();

        return $game ?: null;
    }

    public function getMaxPrice(): float
    {
        $stmt = $this->pdo->query('SELECT MAX(price) FROM games');

        return (float) $stmt->fetchColumn();
    }
    ///decrease game stock by id
    public function decreaseStock(int $id): bool
    {
        $stmt = $this->pdo->prepare('UPDATE games SET stock = stock - 1 WHERE id = :id AND stock > 0');
        return $stmt->execute([':id' => $id]);
    }
    ///increase game stock by id
    public function increaseStock(int $id): bool
    {
        $stmt = $this->pdo->prepare('UPDATE games SET stock = stock + 1 WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    /// Helper method to build the WHERE clause based on filters
    private function buildWhere(array $filters, array &$params): string
    {
        $where = [];

        if (!empty($filters['search'])) {
            $where[] = '(title LIKE :search OR description LIKE :search OR developer LIKE :search)';
            $params[':search'] = '%' . $filters['search'] . '%';
        }

        if (!empty($filters['genres']) && is_array($filters['genres'])) {
            $genreParts = [];

            foreach ($filters['genres'] as $index => $genre) {
                $key = ':genre' . $index;
                $genreParts[] = $key;
                $params[$key] = $genre;
            }

            $where[] = 'genre IN (' . implode(', ', $genreParts) . ')';
        }

        if (isset($filters['max_price']) && $filters['max_price'] !== '') {
            $where[] = 'price <= :max_price';
            $params[':max_price'] = (float) $filters['max_price'];
        }

        if (!empty($filters['only_sale'])) {
            $where[] = 'discount_percent > 0';
        }

        if (!empty($filters['only_new'])) {
            $where[] = 'is_new_release = 1';
        }

        return $where ? 'WHERE ' . implode(' AND ', $where) : '';
    }

}
