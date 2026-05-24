<?php
require_once __DIR__ . '/bootstrap.php';

$controller = new ContactController();
$controller->listMessages();
