<?php
require_once __DIR__ . '/bootstrap.php';

$controller = new ContactController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'show':
        $controller->detail(requireContactId());
        break;

    case 'edit':
        $controller->edit(requireContactId(), $_POST);
        break;

    case 'delete':
        $controller->delete(requireContactId(), $_POST);
        break;

    case 'seen':
        $controller->markSeen(requireContactId(), $_POST);
        break;

    case 'index':
    default:
        $controller->listMessages();
        break;
}

function requireContactId(): int
{
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        die('Invalid ID');
    }

    return (int) $_GET['id'];
}
