<?php require_once __DIR__ . '/../layout/header.php'; ?>

<?php if ($game === null): ?>
    <section class="tabs-section">
        <div class="container">
            <div class="game-empty">
                <h2>No game found</h2>
                <p>The game does not exist or the link is incorrect.</p>
                <a class="btn btn-magenta" href="shop.php">Back to shop</a>
            </div>
        </div>
    </section>
<?php else: ?>
    <?php
    $price = (float) $game['price'];
    $originalPrice = $game['original_price'] !== null ? (float) $game['original_price'] : null;
    $discount = (int) $game['discount_percent'];
    $releaseDate = date('d.m.Y', strtotime($game['release_date']));
    ?>

    <section class="game-hero">
        <div class="game-hero__backdrop"></div>
        <div class="container game-hero__layout">
            <div class="game-hero__media">
                <div class="game-hero__main-thumb">
                    <img class="game-hero__image" src="<?= Helpers::e($game['image_url']) ?>" alt="<?= Helpers::e($game['image_title']) ?>">
                </div>
                <div class="game-hero__thumbs">
                    <div class="thumb-item active">
                        <img class="game-hero__image" src="<?= Helpers::e($game['image_url']) ?>" alt="<?= Helpers::e($game['image_title']) ?>">
                    </div>
                </div>
            </div>

            <aside class="game-sidebar">
                <div class="game-sidebar__box">
                    <h1 class="game-title"><?= Helpers::e($game['title']) ?></h1>
                    <p class="game-developer"><?= Helpers::e($game['developer']) ?> / <?= Helpers::e($game['publisher']) ?></p>

                    <div class="game-tags">
                        <span class="badge badge-cyan"><?= Helpers::e($game['genre']) ?></span>
                        <?php if (!empty($game['secondary_genre'])): ?>
                            <span class="badge badge-cyan"><?= Helpers::e($game['secondary_genre']) ?></span>
                        <?php endif; ?>
                        <span class="badge badge-cyan"><?= Helpers::e($game['age_rating']) ?></span>
                    </div>

                    <div class="game-rating-row">
                        <span class="rating-stars"><?= Helpers::e($controller->getStars((float) $game['rating'])) ?></span>
                        <span class="rating-count"><?= number_format((float) $game['rating'], 1) ?>/5</span>
                    </div>

                    <div class="game-price-row">
                        <div class="game-price"><?= $price <= 0 ? 'FREE' : Helpers::formatPrice($price) ?></div>
                        <?php if ($originalPrice !== null && $originalPrice > $price): ?>
                            <div class="game-price-original"><?= Helpers::formatPrice($originalPrice) ?></div>
                        <?php endif; ?>
                        <?php if ($discount > 0): ?>
                            <div class="game-discount-badge">-<?= $discount ?>%</div>
                        <?php endif; ?>
                    </div>

                    <div class="game-cta">
                        <button class="btn btn-magenta" type="button">Add to cart</button>
                        <a class="game-wishlist" href="shop.php">Back to shop</a>
                    </div>
                </div>

                <div class="game-sidebar__box">
                    <table class="game-info-table">
                        <tr>
                            <td>Platform</td>
                            <td><?= Helpers::e($game['platform']) ?></td>
                        </tr>
                        <tr>
                            <td>Release</td>
                            <td><?= Helpers::e($releaseDate) ?></td>
                        </tr>
                        <tr>
                            <td>Stock</td>
                            <td><?= (int) $game['stock'] ?> keys</td>
                        </tr>
                        <tr>
                            <td>Developer</td>
                            <td><?= Helpers::e($game['developer']) ?></td>
                        </tr>
                        <tr>
                            <td>Publisher</td>
                            <td><?= Helpers::e($game['publisher']) ?></td>
                        </tr>
                    </table>
                </div>
            </aside>
        </div>
    </section>

    <section class="tabs-section">
        <div class="container">
            <div class="tabs">
                <button class="tab-btn active" type="button" data-tab="about">About</button>
                <button class="tab-btn" type="button" data-tab="details">Details</button>
            </div>

            <div class="tab-panel active" data-panel="about">
                <div class="about-grid">
                    <div class="about-desc">
                        <p><?= Helpers::e($game['description']) ?></p>
                    </div>

                    <div class="about-features">
                        <h3>Game info</h3>
                        <div class="feature-list">
                            <div class="feature-item"><?= Helpers::e($game['genre']) ?> gameplay</div>
                            <?php if (!empty($game['secondary_genre'])): ?>
                                <div class="feature-item"><?= Helpers::e($game['secondary_genre']) ?> elements</div>
                            <?php endif; ?>
                            <div class="feature-item"><?= Helpers::e($game['platform']) ?></div>
                            <div class="feature-item"><?= Helpers::e($game['age_rating']) ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-panel" data-panel="details">
                <div class="sysreq-grid">
                    <div class="sysreq-box">
                        <h3>Product details</h3>
                        <table class="sysreq-table">
                            <tr>
                                <td>Title</td>
                                <td><?= Helpers::e($game['title']) ?></td>
                            </tr>
                            <tr>
                                <td>Slug</td>
                                <td><?= Helpers::e($game['slug']) ?></td>
                            </tr>
                            <tr>
                                <td>Rating</td>
                                <td><?= number_format((float) $game['rating'], 1) ?>/5</td>
                            </tr>
                            <tr>
                                <td>New</td>
                                <td><?= (int) $game['is_new_release'] === 1 ? 'Yes' : 'No' ?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="sysreq-box">
                        <h3>Store details</h3>
                        <table class="sysreq-table">
                            <tr>
                                <td>Price</td>
                                <td><?= $price <= 0 ? 'FREE' : Helpers::formatPrice($price) ?></td>
                            </tr>
                            <tr>
                                <td>Discount</td>
                                <td><?= $discount ?>%</td>
                            </tr>
                            <tr>
                                <td>Available</td>
                                <td><?= (int) $game['stock'] ?> keys</td>
                            </tr>
                            <tr>
                                <td>Featured</td>
                                <td><?= (int) $game['is_featured'] === 1 ? 'Yes' : 'No' ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>

<script src="assets/js/main.js"></script>
</body>

</html>


