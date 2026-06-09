<?php
require_once __DIR__ . '/../app/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cart.php');
    exit;
}

$controller = new CartController();
$action = $_POST['action'] ?? '';
$gameId = (int) ($_POST['game_id'] ?? 0);
$redirect = $_POST['redirect'] ?? 'cart.php';

if (!is_string($redirect) || !preg_match('/^[a-z_]+\.php(\?[a-z0-9_=&%+\.-]+)?$/i', $redirect)) {
    $redirect = 'cart.php';
}

if ($action === 'add' && $gameId > 0) {
    $controller->add($gameId);
}

if ($action === 'remove' && $gameId > 0) {
    $controller->remove($gameId);
    $redirect = 'cart.php';
}

if ($action === 'update' && $gameId > 0) {
    $quantity = (int) ($_POST['quantity'] ?? 1);
    $controller->update($gameId, $quantity);
    $redirect = 'cart.php';
}

if ($action === 'clear') {
    $controller->clear();
    $redirect = 'cart.php';
}

if ($action === 'checkout') {
    $checkout = new CheckoutController();
    $orderId = $checkout->submit($_POST);

    if ($orderId === null) {
        $_SESSION['checkout_errors'] = $checkout->getErrors();
        $_SESSION['checkout_old'] = [
            'customer_name' => $_POST['customer_name'] ?? '',
            'customer_email' => $_POST['customer_email'] ?? '',
        ];
    } else {
        $_SESSION['checkout_order_id'] = $orderId;
    }

    $redirect = 'cart.php';
}

header('Location: ' . $redirect);
exit;
