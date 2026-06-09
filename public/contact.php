<?php
require_once __DIR__ . '/../app/bootstrap.php';

$errors = $_SESSION['contact_errors'] ?? [];
$old = $_SESSION['contact_old'] ?? [];

unset($_SESSION['contact_errors'], $_SESSION['contact_old']);

require_once __DIR__ . '/../app/Views/contact/index.php';

