<?php

session_start();

require_once __DIR__ . '/../app/Core/database.php';
require_once __DIR__ . '/../app/Repositories/AdminUserRepository.php';
require_once __DIR__ . '/../app/Repositories/ContactRepository.php';
require_once __DIR__ . '/../app/Repositories/GameRepository.php';

require_once __DIR__ . '/Controllers/BaseController.php';
require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Controllers/DashboardController.php';
require_once __DIR__ . '/Controllers/ContactController.php';
require_once __DIR__ . '/Controllers/UserController.php';
require_once __DIR__ . '/Controllers/GameController.php';
