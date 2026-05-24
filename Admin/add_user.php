<?php
require_once __DIR__ . '/bootstrap.php';

$controller = new UserController();
$controller->add($_POST);
