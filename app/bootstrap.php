<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/Core/helpers.php';
require_once __DIR__ . '/Core/database.php';

require_once __DIR__ . '/Repositories/AdminUserRepository.php';
require_once __DIR__ . '/Repositories/ContactRepository.php';

require_once __DIR__ . '/Controllers/HomeController.php';
require_once __DIR__ . '/Controllers/ContactController.php';
