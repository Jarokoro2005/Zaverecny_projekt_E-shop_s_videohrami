<?php

class GameController extends BaseController
{
    private GameRepository $repo;

    public function __construct()
    {
        $this->repo = new GameRepository();
    }

    public function listGames(): void
    {
        $this->requireLogin();
        $games = $this->repo->getAllGames();
        $this->render('games/index.php', [
            'games' => $games,
            'created' => $_GET['created'] ?? null,
            'updated' => $_GET['updated'] ?? null,
            'deleted' => $_GET['deleted'] ?? null,
        ]);
    }

    public function detail(int $id): void
    {
        $this->requireLogin();
        $game = $this->repo->getById($id);

        if (!$game) {
            die('Game not found');
        }

        $this->render('games/show.php', ['game' => $game]);
    }

    public function create(array $input): void
    {
        $this->requireAdmin();

        $game = $this->buildGameData($input);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadError = $this->handleImageUpload($game);
            if ($uploadError !== null) {
                $errors[] = $uploadError;
            }

            $errors = array_merge($errors, $this->validateGameData($game));

            if (empty($errors)) {
                try {
                    if ($this->repo->createGame($game)) {
                        $this->redirect($this->adminUrl('games.php?created=1'));
                        return;
                    }
                    $errors[] = 'Failed to create game.';
                } catch (PDOException $e) {
                    $errors[] = 'Failed to create game. Check if the slug is unique.';
                }
            }
        }

        $this->render('games/create.php', [
            'game' => $game,
            'errors' => $errors,
        ]);
    }

    public function edit(int $id, array $input): void
    {
        $this->requireAdmin();

        $game = $this->repo->getById($id);
        if (!$game) {
            die('Game not found');
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $game = array_merge($game, $this->buildGameData($input));
            $uploadError = $this->handleImageUpload($game);
            if ($uploadError !== null) {
                $errors[] = $uploadError;
            }

            $errors = array_merge($errors, $this->validateGameData($game));

            if (empty($errors)) {
                try {
                    if ($this->repo->updateGame($id, $game)) {
                        $this->redirect($this->adminUrl('games.php?updated=1'));
                        return;
                    }
                    $errors[] = 'Failed to update game.';
                } catch (PDOException $e) {
                    $errors[] = 'Failed to update game. Check if the slug is unique.';
                }
            }
        }

        $this->render('games/edit.php', [
            'game' => $game,
            'errors' => $errors,
        ]);
    }

    public function delete(int $id, array $input): void
    {
        $this->requireAdmin();

        $game = $this->repo->getById($id);
        if (!$game) {
            die('Game not found');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->repo->deleteGame($id)) {
                $this->redirect($this->adminUrl('games.php?deleted=1'));
                return;
            }
            $error = 'Failed to delete game.';
        }

        $this->render('games/delete.php', [
            'game' => $game,
            'error' => $error,
        ]);
    }

    private function buildGameData(array $input): array
    {
        return [
            'title' => trim($input['title'] ?? ''),
            'slug' => trim($input['slug'] ?? ''),
            'description' => trim($input['description'] ?? ''),
            'price' => $input['price'] ?? '0',
            'original_price' => trim($input['original_price'] ?? ''),
            'discount_percent' => $input['discount_percent'] ?? '0',
            'image_title' => trim($input['image_title'] ?? ''),
            'image_url' => trim($input['image_url'] ?? ''),
            'genre' => trim($input['genre'] ?? ''),
            'secondary_genre' => trim($input['secondary_genre'] ?? ''),
            'rating' => $input['rating'] ?? '0',
            'age_rating' => trim($input['age_rating'] ?? 'PEGI 12'),
            'platform' => trim($input['platform'] ?? 'PC'),
            'developer' => trim($input['developer'] ?? ''),
            'publisher' => trim($input['publisher'] ?? ''),
            'release_date' => trim($input['release_date'] ?? ''),
            'stock' => $input['stock'] ?? '0',
            'is_featured' => isset($input['is_featured']) ? 1 : 0,
            'is_new_release' => isset($input['is_new_release']) ? 1 : 0,
        ];
    }

    private function validateGameData(array $game): array
    {
        $errors = [];

        foreach (['title', 'slug', 'description', 'image_title', 'image_url', 'genre', 'age_rating', 'platform', 'developer', 'publisher', 'release_date'] as $field) {
            if (trim((string) ($game[$field] ?? '')) === '') {
                $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
            }
        }

        if (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', (string) ($game['slug'] ?? ''))) {
            $errors[] = 'Slug can contain only lowercase letters, numbers, and hyphens.';
        }

        if (!is_numeric($game['price']) || (float) $game['price'] < 0) {
            $errors[] = 'Price must be 0 or higher.';
        }

        if ($game['original_price'] !== '' && (!is_numeric($game['original_price']) || (float) $game['original_price'] < 0)) {
            $errors[] = 'Original price must be empty or 0 or higher.';
        }

        if (!is_numeric($game['discount_percent']) || (int) $game['discount_percent'] < 0 || (int) $game['discount_percent'] > 100) {
            $errors[] = 'Discount must be between 0 and 100.';
        }

        if (!is_numeric($game['rating']) || (float) $game['rating'] < 0 || (float) $game['rating'] > 5) {
            $errors[] = 'Rating must be between 0 and 5.';
        }

        if (!is_numeric($game['stock']) || (int) $game['stock'] < 0) {
            $errors[] = 'Stock must be 0 or higher.';
        }

        $date = DateTime::createFromFormat('Y-m-d', (string) ($game['release_date'] ?? ''));
        if (!$date || $date->format('Y-m-d') !== $game['release_date']) {
            $errors[] = 'Release date must be a valid date.';
        }

        return $errors;
    }

    private function handleImageUpload(array &$game): ?string
    {
        if (empty($_FILES['image_file']) || !is_array($_FILES['image_file'])) {
            return null;
        }

        $file = $_FILES['image_file'];

        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
            return 'Image upload failed.';
        }

        if (($file['size'] ?? 0) > 5 * 1024 * 1024) {
            return 'Image must be smaller than 5 MB.';
        }

        $tmpName = $file['tmp_name'] ?? '';
        if ($tmpName === '' || !is_uploaded_file($tmpName)) {
            return 'Invalid uploaded image.';
        }

        $imageInfo = getimagesize($tmpName);
        if ($imageInfo === false) {
            return 'Uploaded file must be an image.';
        }

        $allowedMimeTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
        ];

        $mimeType = $imageInfo['mime'] ?? '';
        if (!isset($allowedMimeTypes[$mimeType])) {
            return 'Image must be JPG, PNG, WEBP, or GIF.';
        }

        $baseName = $game['slug'] !== '' ? $game['slug'] : strtolower((string) preg_replace('/[^a-z0-9]+/i', '-', $game['title']));
        $baseName = trim((string) preg_replace('/[^a-z0-9-]+/', '', $baseName), '-');
        if ($baseName === '') {
            $baseName = 'game-image';
        }

        $fileName = $baseName . '-' . time() . '.' . $allowedMimeTypes[$mimeType];
        $uploadDir = __DIR__ . '/../../public/assets/images/games';
        $targetPath = $uploadDir . '/' . $fileName;

        if (!is_dir($uploadDir)) {
            return 'Image upload folder does not exist.';
        }

        if (!move_uploaded_file($tmpName, $targetPath)) {
            return 'Could not save uploaded image.';
        }

        $game['image_url'] = 'assets/images/games/' . $fileName;

        if ($game['image_title'] === '') {
            $game['image_title'] = $game['title'] . ' cover art';
        }

        return null;
    }
}
