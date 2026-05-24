<?php
require_once __DIR__ . '/../app/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['contact_errors'] = ['Formular bol otvoreny nespravnym sposobom.'];
    header('Location: contact.php');
    exit;
}

$controller = new ContactController();

if (!$controller->submit($_POST)) {
    $_SESSION['contact_errors'] = $controller->getErrors();
    $_SESSION['contact_old'] = $_POST;
    header('Location: contact.php');
    exit;
}

unset($_SESSION['contact_errors'], $_SESSION['contact_old']);
header('Location: thankyou.php');
exit;
