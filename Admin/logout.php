<?php
require_once __DIR__ . '/bootstrap.php';

$auth = new AuthController();
$auth->logout();
