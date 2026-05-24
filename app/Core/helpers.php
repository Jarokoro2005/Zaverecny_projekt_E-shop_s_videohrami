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
