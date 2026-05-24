<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="GameVault Admin Panel" />
    <title>GameVault Admin</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/testlen/public/assets/css/global.css">
    <link rel="stylesheet" href="/testlen/public/assets/css/admin.css?v=4">
</head>

<body>

    <nav class="navbar">
        <div class="container navbar__inner">
            <!-- Logo -->
            <a href="/testlen/public/index.php" class="navbar__logo">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path
                        d="M21 6H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1ZM11 13H9v2H7v-2H5v-2h2V9h2v2h2v2Zm4-1a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm3 2a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                </svg>
                GAME<span style="color: var(--magenta)">VAULT</span> Admin
            </a>

            <?php if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"]): ?>
                <!-- Links -->
                <ul class="navbar__links">
                    <li><a href="/testlen/Admin/index.php">Dashboard</a></li>
                    <li><a href="/testlen/Admin/contact_messages.php">Messages</a></li>
                    <?php if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "admin"): ?>
                        <li><a href="/testlen/Admin/add_user.php">Add User</a></li>
                    <?php endif; ?>
                </ul>

                <!-- Actions -->
                <div class="navbar__actions">
                    <a href="/testlen/Admin/logout.php" class="btn btn--primary">Logout</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <main class="container">