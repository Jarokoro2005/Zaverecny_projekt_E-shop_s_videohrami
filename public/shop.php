<?php
require_once __DIR__ . '/../app/bootstrap.php';

$controller = new ShopController();
$filters = $controller->getFilters();
$genres = $controller->getGenres();
$games = $controller->getGames();

require_once __DIR__ . '/../app/Views/shop/index.php';

