<?php
require_once __DIR__ . '/bootstrap.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid ID');
}

$controller = new ContactController();
$controller->detail((int) $_GET['id']);
