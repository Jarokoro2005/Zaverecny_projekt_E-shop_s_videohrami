<?php require_once __DIR__ . '/../layout/header.php'; ?>


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
        <a href="shop.php" class="btn btn-solid"><span>Browse Games</span></a>
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
<br>

<br>
<br>


<!-- CATEGORIES -->
<section class="section" style="padding-top: 0">
  <div class="container">
    <h2 class="section-title">Browse by <span>Genre</span></h2>
    <div class="section-line"></div>

    <div class="categories-grid">
      <a href="shop.php?genre%5B%5D=Action+RPG" class="cat-card"><span class="cat-card__icon">⚔️</span><span
          class="cat-card__name">Action RPG</span></a>
      <a href="shop.php?genre%5B%5D=Adventure" class="cat-card"><span class="cat-card__icon">🧙</span><span
          class="cat-card__name">Adventure</span></a>

      <a href="shop.php?genre%5B%5D=FPS" class="cat-card"><span class="cat-card__icon">🔫</span><span
          class="cat-card__name">FPS</span></a>
      <a href="shop.php?genre%5B%5D=Metroidvania" class="cat-card"><span class="cat-card__icon">🧩</span><span
          class="cat-card__name">Metroidvania</span></a>
      <a href="shop.php?genre%5B%5D=Sports" class="cat-card"><span class="cat-card__icon">🏎️</span><span
          class="cat-card__name">Sports</span></a>
      <a href="shop.php?genre%5B%5D=Sandbox" class="cat-card"><span class="cat-card__icon">👾</span><span
          class="cat-card__name">Sandbox</span></a>
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
        <a href="shop.php?sort=discount" class="btn btn-magenta" style="margin-top: 1.5rem">
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

<!-- FOOTER -->

<?php require_once __DIR__ . '/../layout/footer.php'; ?>

<script src="assets/js/main.js"></script>
</body>

</html>

