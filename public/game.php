<?php
require_once __DIR__ . '/../app/bootstrap.php';

$controller = new GameDetailController();
$game = $controller->getGame();

require_once __DIR__ . '/../app/Views/games/detail.php';

