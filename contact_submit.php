<?php
require_once __DIR__ . "/App/Repositories/ContactRepository.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: contact.php?error=invalid_request");
    exit;
}

// Načítanie dát
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$topic = trim($_POST["topic"] ?? "");
$message = trim($_POST["message"] ?? "");
$newsletter = isset($_POST["newsletter"]) ? 1 : 0;

// Validácia
$errors = [];

if ($name === "")
    $errors[] = "Name is required.";
if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL))
    $errors[] = "Valid email is required.";
if ($topic === "")
    $errors[] = "Topic is required.";
if ($message === "")
    $errors[] = "Message is required.";

if (!empty($errors)) {
    $errorString = urlencode(implode(" ", $errors));
    header("Location: contact.php?error=$errorString");
    exit;
}

// Uloženie cez repository
try {
    $repo = new ContactRepository();
    $repo->createContact($name, $email, $topic, $message, $newsletter);

    header("Location: thankyou.php");
    exit;

} catch (Exception $e) {
    $err = urlencode("Database error: " . $e->getMessage());
    header("Location: contact.php?error=$err");
    exit;
}
