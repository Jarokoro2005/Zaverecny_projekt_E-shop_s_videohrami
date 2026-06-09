<?php
require_once __DIR__ . '/../app/bootstrap.php';

$controller = new CartController();
$cart = $controller->index();
$items = $cart['items'];
$total = $cart['total'];
$errors = $_SESSION['checkout_errors'] ?? [];
$old = $_SESSION['checkout_old'] ?? [];
$orderId = $_SESSION['checkout_order_id'] ?? null;

unset($_SESSION['checkout_errors'], $_SESSION['checkout_old'], $_SESSION['checkout_order_id']);

require_once __DIR__ . '/../app/Views/cart/index.php';
