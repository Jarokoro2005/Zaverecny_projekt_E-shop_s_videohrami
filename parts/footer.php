<footer class="footer">
  <div class="container">
    <div class="footer__grid">
      <!-- Brand -->
      <div class="footer__brand">
        <div class="navbar__logo" style="margin-bottom: 0.6rem">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="
                  width: 22px;
                  height: 22px;
                  fill: var(--cyan);
                  filter: drop-shadow(0 0 5px var(--cyan));
                ">
            <path
              d="M21 6H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1ZM11 13H9v2H7v-2H5v-2h2V9h2v2h2v2Zm4-1a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm3 2a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
          </svg>
          GAME<span style="color: var(--magenta)">VAULT</span>
        </div>
        <p class="footer__brand-desc">
          Your ultimate digital game store. Thousands of titles, instant
          delivery, and the best deals in the galaxy — all in one place.
        </p>
      </div>

      <!-- Store links -->
      <div>
        <p class="footer__col-title">Store</p>
        <nav class="footer__col-links">
          <a href="shop.php">All Games</a>
          <a href="shop.php?genre=action">Action</a>
          <a href="shop.php?genre=rpg">RPG</a>
          <a href="shop.php?sort=discount">On Sale</a>
          <a href="shop.php?sort=new">New Releases</a>
        </nav>
      </div>

      <!-- Support links -->
      <div>
        <p class="footer__col-title">Support</p>
        <nav class="footer__col-links">
          <a href="contact.php">Contact Us</a>
          <a href="#">Help Center</a>
          <a href="#">Refund Policy</a>
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
        </nav>
      </div>

      <!-- Company links -->
      <div>
        <p class="footer__col-title">Company</p>
        <nav class="footer__col-links">
          <a href="#">About Us</a>
          <a href="#">Careers</a>
          <a href="#">Press Kit</a>
          <a href="#">Partners</a>
          <a href="#">Blog</a>
        </nav>
      </div>
    </div>

    <!-- Bottom bar -->
    <div class="footer__bottom">
      <span>&copy; <?php echo date("Y"); ?> GameVault. All rights reserved.</span>
      <div class="footer__social">
        <a href="#" aria-label="Twitter/X">𝕏</a>
        <a href="#" aria-label="Discord">🎮</a>
        <a href="#" aria-label="YouTube">▶</a>
        <a href="#" aria-label="Twitch">📺</a>
      </div>
    </div>
  </div>
</footer>