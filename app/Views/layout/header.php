<?php $meta = Helpers::getMeta(); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= htmlspecialchars($meta['description'], ENT_QUOTES, 'UTF-8') ?>" />
    <title><?= htmlspecialchars($meta['title'], ENT_QUOTES, 'UTF-8') ?></title>

    <?php Helpers::getCSS(); ?>
</head>

<body>

    <nav class="navbar">
        <div class="container navbar__inner">
            <a href="index.php" class="navbar__logo">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path
                        d="M21 6H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1ZM11 13H9v2H7v-2H5v-2h2V9h2v2h2v2Zm4-1a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm3 2a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                </svg>
                GAME<span style="color: var(--magenta)">VAULT</span>
            </a>

            <ul class="navbar__links" id="navLinks">
                <?php Helpers::printMenu(Helpers::getMenu(), Helpers::getActiveClass()); ?>
            </ul>

            <div class="navbar__actions">
                <a class="navbar__cart" href="cart.php" aria-label="Shopping cart">
                    🛒 <span>Cart</span>
                    <span class="navbar__cart-count"><?= CartController::countItems() ?></span>
                </a>
                <button class="navbar__toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>
