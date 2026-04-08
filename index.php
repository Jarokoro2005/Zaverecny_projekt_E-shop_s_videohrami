<?php
include_once("functions.php");
?>

<?php require("parts/header.php"); ?>

<!-- NAV (you said you'll paste it later) -->

<?php require("parts/nav.php"); ?>

<!-- HERO -->
<section class="hero">
  <div class="hero__bg"></div>
  <div class="hero__grid"></div>
  <div class="hero__orb hero__orb--1"></div>
  <div class="hero__orb hero__orb--2"></div>

  <div class="container">
    <div class="hero__content">
      <p class="hero__eyebrow">New Season Drop</p>
      <h1 class="hero__title">
        <span class="line-dim">Enter the</span>
        <span class="line-cyan">Vault</span>
        <span class="line-white">Level&nbsp;Up</span>
      </h1>
      <p class="hero__desc">
        Over 10,000 titles across every genre. Instant digital delivery,
        exclusive bundles, and deals that hit harder than a final boss.
      </p>

      <div class="hero__cta">
        <a href="shop.html" class="btn btn-solid"><span>Browse Games</span></a>
        <a href="shop.html?sort=discount" class="btn btn-magenta"><span>View Deals</span></a>
      </div>

      <div class="hero__stats">
        <div class="hero__stat">
          <span class="hero__stat-value">10K+</span><span class="hero__stat-label">Games</span>
        </div>
        <div class="hero__stat">
          <span class="hero__stat-value">2M+</span><span class="hero__stat-label">Players</span>
        </div>
        <div class="hero__stat">
          <span class="hero__stat-value">99%</span><span class="hero__stat-label">Uptime</span>
        </div>
        <div class="hero__stat">
          <span class="hero__stat-value">4.9★</span><span class="hero__stat-label">Rating</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TICKER -->
<div class="ticker" aria-hidden="true">
  <div class="ticker__track">
    <span class="ticker__item"><span>New Release</span> Neon Blade: Origins
      <span class="ticker__dot">◆</span></span>
    <span class="ticker__item"><span>Hot Deal</span> Stellar Odyssey 2
      <span class="ticker__dot">◆</span></span>
    <span class="ticker__item"><span>Top Rated</span> Void Protocol
      <span class="ticker__dot">◆</span></span>
    <span class="ticker__item"><span>On Sale</span> Cyber Knights RPG
      <span class="ticker__dot">◆</span></span>
    <span class="ticker__item"><span>Coming Soon</span> DarkMatter Zero
      <span class="ticker__dot">◆</span></span>
  </div>
</div>

<!-- FEATURED GAMES -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Featured <span>Titles</span></h2>
    <div class="section-line"></div>

    <div class="featured-grid">
      <!-- Game 1 -->
      <a href="game.html" class="game-card">
        <div class="game-card__thumb">
          <div class="game-card__thumb-placeholder" style="
                  background: linear-gradient(
                    135deg,
                    rgba(255, 45, 120, 0.15) 0%,
                    rgba(9, 11, 16, 1) 100%
                  );
                ">
            NEON BLADE: ORIGINS
          </div>
          <div class="game-card__overlay"></div>
          <div class="game-card__tags">
            <span class="badge badge-cyan">NEW</span>
            <span class="badge badge-magenta">HOT</span>
          </div>
        </div>
        <div class="game-card__body">
          <h3 class="game-card__title">Neon Blade: Origins</h3>
          <span class="text-muted mono" style="font-size: 0.78rem">Action RPG</span>
          <div class="game-card__meta">
            <div class="game-card__price">
              <span class="original">$49.99</span> $29.99
            </div>
            <span class="game-card__rating">★★★★★</span>
          </div>
        </div>
      </a>

      <!-- Game 2 -->
      <a href="game.html" class="game-card">
        <div class="game-card__thumb">
          <div class="game-card__thumb-placeholder" style="
                  background: linear-gradient(
                    135deg,
                    rgba(0, 255, 231, 0.15) 0%,
                    rgba(9, 11, 16, 1) 100%
                  );
                ">
            STELLAR ODYSSEY 2
          </div>
          <div class="game-card__overlay"></div>
          <div class="game-card__tags">
            <span class="badge badge-yellow">SALE</span>
          </div>
        </div>
        <div class="game-card__body">
          <h3 class="game-card__title">Stellar Odyssey 2</h3>
          <span class="text-muted mono" style="font-size: 0.78rem">Space Sim</span>
          <div class="game-card__meta">
            <div class="game-card__price">$19.99</div>
            <span class="game-card__rating">★★★★☆</span>
          </div>
        </div>
      </a>

      <!-- Game 3 -->
      <a href="game.html" class="game-card">
        <div class="game-card__thumb">
          <div class="game-card__thumb-placeholder" style="
                  background: linear-gradient(
                    135deg,
                    rgba(150, 80, 255, 0.15) 0%,
                    rgba(9, 11, 16, 1) 100%
                  );
                ">
            VOID PROTOCOL
          </div>
          <div class="game-card__overlay"></div>
          <div class="game-card__tags">
            <span class="badge badge-cyan">TOP RATED</span>
          </div>
        </div>
        <div class="game-card__body">
          <h3 class="game-card__title">Void Protocol</h3>
          <span class="text-muted mono" style="font-size: 0.78rem">FPS / Thriller</span>
          <div class="game-card__meta">
            <div class="game-card__price">$44.99</div>
            <span class="game-card__rating">★★★★★</span>
          </div>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- CATEGORIES -->
<section class="section" style="padding-top: 0">
  <div class="container">
    <h2 class="section-title">Browse by <span>Genre</span></h2>
    <div class="section-line"></div>

    <div class="categories-grid">
      <a href="shop.html?genre=action" class="cat-card"><span class="cat-card__icon">⚔️</span><span
          class="cat-card__name">Action</span></a>
      <a href="shop.html?genre=rpg" class="cat-card"><span class="cat-card__icon">🧙</span><span
          class="cat-card__name">RPG</span></a>
      <a href="shop.html?genre=sci-fi" class="cat-card"><span class="cat-card__icon">🚀</span><span
          class="cat-card__name">Sci-Fi</span></a>
      <a href="shop.html?genre=puzzle" class="cat-card"><span class="cat-card__icon">🧩</span><span
          class="cat-card__name">Puzzle</span></a>
      <a href="shop.html?genre=racing" class="cat-card"><span class="cat-card__icon">🏎️</span><span
          class="cat-card__name">Racing</span></a>
      <a href="shop.html?genre=indie" class="cat-card"><span class="cat-card__icon">👾</span><span
          class="cat-card__name">Indie</span></a>
    </div>
  </div>
</section>

<!-- PROMO -->
<section class="section" style="padding-top: 0">
  <div class="container">
    <div class="promo-banner">
      <div>
        <p class="promo-banner__eyebrow">⚡ Flash Sale — Ends Soon</p>
        <h2 class="promo-banner__title">
          Up to <span class="text-cyan">80% Off</span><br />Weekend Deals
        </h2>
        <p class="promo-banner__desc">
          Hundreds of titles slashed. Limited time only — don't sleep on
          this.
        </p>
        <a href="shop.html?sort=discount" class="btn btn-magenta" style="margin-top: 1.5rem">
          <span>Shop the Sale</span>
        </a>
      </div>

      <div class="promo-banner__countdown hero-countdown">
        <div class="countdown-unit">
          <span class="countdown-unit__val">11</span><span class="countdown-unit__label">Hrs</span>
        </div>
        <div class="countdown-unit">
          <span class="countdown-unit__val">47</span><span class="countdown-unit__label">Min</span>
        </div>
        <div class="countdown-unit">
          <span class="countdown-unit__val">32</span><span class="countdown-unit__label">Sec</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER (you said you'll paste it later) -->

<?php include("parts/footer.php"); ?>

<script src="js/main.js"></script>
</body>

</html>