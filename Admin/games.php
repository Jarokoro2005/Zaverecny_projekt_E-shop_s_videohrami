<?php
require_once __DIR__ . '/bootstrap.php';

$controller = new GameController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'show':
        $controller->detail(requireGameId());
        break;

    case 'create':
        $controller->create($_POST);
        break;

    case 'edit':
        $controller->edit(requireGameId(), $_POST);
        break;

    case 'delete':
        $controller->delete(requireGameId(), $_POST);
        break;


    case 'index':
    default:
        $controller->listGames();
        break;
}

function requireGameId(): int
{
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        die('Invalid ID');
    }

    return (int) $_GET['id'];
}
