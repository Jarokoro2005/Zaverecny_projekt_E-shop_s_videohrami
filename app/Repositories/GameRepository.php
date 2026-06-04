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

    public function getAllGames(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM games ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM games WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $game = $stmt->fetch();

        return $game ?: null;
    }

    public function createGame(array $game): bool
    {
        $sql = "INSERT INTO games (
                    title, slug, description, price, original_price, discount_percent,
                    image_title, image_url, genre, secondary_genre, rating, age_rating,
                    platform, developer, publisher, release_date, stock, is_featured, is_new_release
                ) VALUES (
                    :title, :slug, :description, :price, :original_price, :discount_percent,
                    :image_title, :image_url, :genre, :secondary_genre, :rating, :age_rating,
                    :platform, :developer, :publisher, :release_date, :stock, :is_featured, :is_new_release
                )";

        return $this->executeGameStatement($sql, $game);
    }

    public function updateGame(int $id, array $game): bool
    {
        $sql = "UPDATE games
                SET title = :title,
                    slug = :slug,
                    description = :description,
                    price = :price,
                    original_price = :original_price,
                    discount_percent = :discount_percent,
                    image_title = :image_title,
                    image_url = :image_url,
                    genre = :genre,
                    secondary_genre = :secondary_genre,
                    rating = :rating,
                    age_rating = :age_rating,
                    platform = :platform,
                    developer = :developer,
                    publisher = :publisher,
                    release_date = :release_date,
                    stock = :stock,
                    is_featured = :is_featured,
                    is_new_release = :is_new_release
                WHERE id = :id";

        $game['id'] = $id;

        return $this->executeGameStatement($sql, $game);
    }

    public function deleteGame(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM games WHERE id = :id');
        return $stmt->execute([':id' => $id]);
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

    private function executeGameStatement(string $sql, array $game): bool
    {
        $stmt = $this->pdo->prepare($sql);
        $params = [
            ':title' => $game['title'],
            ':slug' => $game['slug'],
            ':description' => $game['description'],
            ':price' => (float) $game['price'],
            ':original_price' => $game['original_price'] === '' ? null : (float) $game['original_price'],
            ':discount_percent' => (int) $game['discount_percent'],
            ':image_title' => $game['image_title'],
            ':image_url' => $game['image_url'],
            ':genre' => $game['genre'],
            ':secondary_genre' => $game['secondary_genre'] === '' ? null : $game['secondary_genre'],
            ':rating' => (float) $game['rating'],
            ':age_rating' => $game['age_rating'],
            ':platform' => $game['platform'],
            ':developer' => $game['developer'],
            ':publisher' => $game['publisher'],
            ':release_date' => $game['release_date'],
            ':stock' => (int) $game['stock'],
            ':is_featured' => (int) $game['is_featured'],
            ':is_new_release' => (int) $game['is_new_release'],
        ];

        if (isset($game['id'])) {
            $params[':id'] = (int) $game['id'];
        }

        return $stmt->execute($params);
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
