<?php

class Helpers
{
    private const DATA_FILE = __DIR__ . '/../Data/datas.json';

    private function __construct()
    {
        // Static helper class; instantiation is not allowed.
    }

    private static function loadData(): array
    {
        $jsonStr = @file_get_contents(self::DATA_FILE);
        $data = json_decode($jsonStr, true);

        return is_array($data) ? $data : [];
    }

    private static function resolvePageName(): string
    {
        $page = basename($_SERVER['REQUEST_URI']);

        if ($page === '' || $page === '/' || !str_contains($page, '.')) {
            return 'index';
        }

        return explode('.', $page)[0];
    }

    public static function getMeta(): array
    {
        $data = self::loadData();
        $page = self::resolvePageName();

        return $data['meta'][$page] ?? [
            'title' => 'GameVault',
            'description' => 'The best place to buy digital games. Thousands of titles, unbeatable prices, instant delivery.',
        ];
    }

    public static function getCSS(): void
    {
        $data = self::loadData();
        $page = self::resolvePageName();

        if (isset($data['sites'][$page]) && is_array($data['sites'][$page])) {
            foreach ($data['sites'][$page] as $file) {
                echo "<link rel='stylesheet' href='${file}'>";
            }
        }
    }

    public static function getActiveClass(): string
    {
        $page = basename($_SERVER['REQUEST_URI']);
        return explode('.', $page)[0];
    }

    public static function getMenu(): array
    {
        $data = self::loadData();
        return $data['menu'] ?? [];
    }

    public static function printMenu(array $menu, string $currentPage): void
    {
        foreach ($menu as $key => $item) {
            $active = ($currentPage === $key) ? "class='active'" : '';
            echo "<li><a href='{$item['path']}' {$active}>{$item['name']}</a></li>";
        }
    }

    public static function printGenreFilters(array $genres, array $selectedGenres): void
    {
        foreach ($genres as $genre) {
            $genreName = $genre['genre'];
            $genreId = 'genre-' . self::slug($genreName);
            $isChecked = in_array($genreName, $selectedGenres, true) ? 'checked' : '';
            $gameCount = (int) $genre['game_count'];

            echo "
                <div class='filter-item'>
                    <input
                        type='checkbox'
                        id='" . self::e($genreId) . "'
                        name='genre[]'
                        value='" . self::e($genreName) . "'
                        {$isChecked}
                    >
                    <label for='" . self::e($genreId) . "'>
                        " . self::e($genreName) . "
                        <span class='filter-count'>{$gameCount}</span>
                    </label>
                </div>
            ";
        }
    }

    public static function printHiddenGenreInputs(array $genres): void
    {
        foreach ($genres as $genre) {
            echo "<input type='hidden' name='genre[]' value='" . self::e($genre) . "'>";
        }
    }

    public static function printGameCards(array $games): void
    {
        foreach ($games as $game) {
            self::printGameCard($game);
        }
    }

    private static function printGameCard(array $game): void
    {
        $price = (float) $game['price'];
        $originalPrice = $game['original_price'] !== null ? (float) $game['original_price'] : null;
        $discount = (int) $game['discount_percent'];
        $isFree = $price <= 0;
        ?>
        <a class="shop-card" href="game.php?slug=<?= self::e($game['slug']) ?>">
            <div class="shop-card__thumb">
                <img
                    class="shop-card__image"
                    src="<?= self::e($game['image_url']) ?>"
                    alt="<?= self::e($game['image_title']) ?>"
                    loading="lazy"
                >
                <?php if ($discount > 0): ?>
                    <span class="shop-card__discount">-<?= $discount ?>%</span>
                <?php endif; ?>
            </div>

            <div class="shop-card__body">
                <p class="shop-card__genre">
                    <?= self::e($game['genre']) ?>
                    <?php if (!empty($game['secondary_genre'])): ?>
                        / <?= self::e($game['secondary_genre']) ?>
                    <?php endif; ?>
                </p>
                <h3 class="shop-card__title"><?= self::e($game['title']) ?></h3>
                <p class="shop-card__description"><?= self::e(self::shortText($game['description'])) ?></p>

                <div class="shop-card__tags">
                    <?php if ((int) $game['is_new_release'] === 1): ?>
                        <span class="badge badge-cyan">NEW</span>
                    <?php endif; ?>
                    <?php if ((int) $game['is_featured'] === 1): ?>
                        <span class="badge badge-cyan">FEATURED</span>
                    <?php endif; ?>
                    <span class="badge badge-cyan"><?= number_format((float) $game['rating'], 1) ?>/5</span>
                </div>

                <div class="shop-card__footer">
                    <div class="shop-card__price">
                        <?php if ($originalPrice !== null && $originalPrice > $price): ?>
                            <span class="original"><?= self::formatPrice($originalPrice) ?></span>
                        <?php endif; ?>
                        <?= $isFree ? 'FREE' : self::formatPrice($price) ?>
                    </div>
                    <span class="shop-card__add" aria-label="Open <?= self::e($game['title']) ?>">+</span>
                </div>
            </div>
        </a>
        <?php
    }

    public static function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public static function slug(string $text): string
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);

        return trim((string) $text, '-');
    }

    public static function formatPrice(float $price): string
    {
        return number_format($price, 2, ',', ' ') . ' EUR';
    }

    public static function shortText(string $text, int $length = 115): string
    {
        return strlen($text) > $length ? substr($text, 0, $length) . '...' : $text;
    }

    public static function pricePercent(float $currentPrice, float $highestPrice): int
    {
        if ($highestPrice <= 0) {
            return 0;
        }

        return (int) min(100, max(0, ($currentPrice / $highestPrice) * 100));
    }

    public static function initTheme(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_GET['theme']) && in_array($_GET['theme'], ['light', 'dark'], true)) {
            $_SESSION['theme'] = $_GET['theme'];
        }

        if (!isset($_SESSION['theme'])) {
            $_SESSION['theme'] = 'dark';
        }
    }

    public static function getTheme(): string
    {
        return $_SESSION['theme'] ?? 'dark';
    }

    public static function getThemeIcon(): string
    {
        return self::getTheme() === 'light' ? '☀️' : '🌙';
    }
}
