<?php
include_once("functions.php");
$nane_of_page = getActiveClass();
?>
<nav class="navbar">
    <div class="container navbar__inner">
        <!-- Logo -->
        <a href="index.php" class="navbar__logo">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path
                    d="M21 6H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1ZM11 13H9v2H7v-2H5v-2h2V9h2v2h2v2Zm4-1a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm3 2a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
            </svg>
            GAME<span style="color: var(--magenta)">VAULT</span>
        </a>

        <!-- Links -->
        <ul class="navbar__links" id="navLinks">
            <?php printMenu(getMenu(), getActiveClass()); ?>
            <!-- <li><a href="index.php" class="active">Home</a></li> -->


        </ul>
        <!-- Actions -->
        <div class="navbar__actions">
            <button class="navbar__cart" aria-label="Shopping cart">
                🛒 <span>Cart</span>
                <span class="navbar__cart-count">3</span>
            </button>
            <button class="navbar__toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</nav>