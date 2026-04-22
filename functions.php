<?php
$data_dir = __DIR__ . "/App/Data/datas.json";
function getMeta(): array
{
    // 1. načítame JSON
    global $data_dir;
    $jsonStr = file_get_contents($data_dir);
    $data = json_decode($jsonStr, true);

    // 2. zistíme názov stránky

    $stranka = basename($_SERVER['REQUEST_URI']);
    if ($stranka === "" || $stranka === "/" || !str_contains($stranka, ".")) {
        $stranka = "index";
    } else {
        $stranka = explode(".", $stranka)[0];
    }


    // 3. ak meta existuje → vrátime ju
    if (isset($data["meta"][$stranka])) {
        return $data["meta"][$stranka];
    }
    // 4. fallback ak stránka nemá meta
    return [
        "title" => "GameVault",
        "description" => "THe best place to buy digital games. Thousands of titles, unbeatable prices, instant delivery."
    ];
}

function getCSS(): void
{
    global $data_dir;
    $jsonStr = file_get_contents($data_dir);
    $data = json_decode($jsonStr, true);


    $stranka = basename($_SERVER['REQUEST_URI']);

    if ($stranka === "" || $stranka === "/" || !str_contains($stranka, ".")) {
        $stranka = "index";
    } else {
        $stranka = explode(".", $stranka)[0];
    }

    if (isset($data["sites"][$stranka])) {
        $suboryCSS = $data["sites"][$stranka];

        foreach ($suboryCSS as $subor) {
            echo "<link rel='stylesheet' href='$subor'>";
        }
    }
    echo "<!-- stranka: $stranka -->";
}
function getActiveClass(): string
{

    $stranka = basename($_SERVER['REQUEST_URI']);
    $stranka = explode(".", $stranka)[0];

    return $stranka;
}

function getMenu(): array
{
    global $data_dir;
    $jsonStr = file_get_contents($data_dir);
    $data = json_decode($jsonStr, true);

    return $data["menu"] ?? [];
}


function printMenu(array $menu, string $currentPage): void
{
    foreach ($menu as $key => $item) {
        $active = ($currentPage === $key) ? "class='active'" : "";
        echo "<li><a href='{$item['path']}' {$active}>{$item['name']}</a></li>";
    }
}

// Theme handling with PHP
function initTheme(): void
{
    // Start session if not already started (MUST be first!)
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if theme is being changed via GET parameter
    if (isset($_GET['theme']) && ($_GET['theme'] === 'light' || $_GET['theme'] === 'dark')) {
        $_SESSION['theme'] = $_GET['theme'];
    }

    // Set default theme to 'dark' if not set
    if (!isset($_SESSION['theme'])) {
        $_SESSION['theme'] = 'dark';
    }
}

function getTheme(): string
{
    return $_SESSION['theme'] ?? 'dark';
}

function getThemeIcon(): string
{
    return getTheme() === 'light' ? '☀️' : '🌙';
}

?>