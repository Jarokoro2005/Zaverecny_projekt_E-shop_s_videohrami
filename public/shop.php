<?php
require_once __DIR__ . '/../app/bootstrap.php';

$shopPage = new ShopPage();
$filters = $shopPage->getFilters();
$genres = $shopPage->getGenres();
$games = $shopPage->getGames();

require_once __DIR__ . '/../app/Views/layout/header.php';
?>

<div class="container">
    <div class="page-header">
        <p class="page-header__eyebrow">// Browse the collection</p>
        <h1 class="page-header__title">The <span>Store</span></h1>
    </div>

    <div class="shop-layout">
        <aside class="sidebar" aria-label="Filters">
            <div class="sidebar__filters-toggle">
                <span>Filters</span>
                <span class="ft-arrow">v</span>
            </div>

            <form class="sidebar__body" method="get" action="shop.php">
                <input type="hidden" name="search" value="<?= Helpers::e($filters['search']) ?>">

                <div class="sidebar__section">
                    <h2 class="sidebar__title">Genre</h2>
                    <div class="filter-list">
                        <?php Helpers::printGenreFilters($genres, $filters['genres']); ?>
                    </div>
                </div>

                <div class="sidebar__section">
                    <h2 class="sidebar__title">Max Price</h2>
                    <div class="price-range">
                        <input
                            type="range"
                            class="price-slider"
                            name="max_price"
                            min="0"
                            max="<?= (int) $shopPage->getHighestPrice() ?>"
                            value="<?= Helpers::e((string) $filters['max_price']) ?>"
                            style="--val: <?= Helpers::pricePercent((float) $filters['max_price'], $shopPage->getHighestPrice()) ?>%"
                        >
                        <div class="price-labels">
                            <span>0 EUR</span>
                            <span class="price-max"><?= Helpers::formatPrice((float) $filters['max_price']) ?></span>
                        </div>
                    </div>
                </div>

                <div class="sidebar__section">
                    <h2 class="sidebar__title">Offers</h2>
                    <div class="filter-list">
                        <div class="filter-item">
                            <input type="checkbox" id="offer-sale" name="sale" value="1" <?= !empty($filters['only_sale']) ? 'checked' : '' ?>>
                            <label for="offer-sale">On Sale</label>
                        </div>
                        <div class="filter-item">
                            <input type="checkbox" id="offer-new" name="new" value="1" <?= !empty($filters['only_new']) ? 'checked' : '' ?>>
                            <label for="offer-new">New Releases</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-magenta" type="submit" style="width: 100%; justify-content: center">
                    <span>Apply Filters</span>
                </button>

                <a class="sidebar__reset" href="shop.php">Reset filters</a>
            </form>
        </aside>

        <main>
            <form class="shop-toolbar" method="get" action="shop.php">
                <?php Helpers::printHiddenGenreInputs($filters['genres']); ?>
                <input type="hidden" name="max_price" value="<?= Helpers::e((string) $filters['max_price']) ?>">
                <?php if (!empty($filters['only_sale'])): ?>
                    <input type="hidden" name="sale" value="1">
                <?php endif; ?>
                <?php if (!empty($filters['only_new'])): ?>
                    <input type="hidden" name="new" value="1">
                <?php endif; ?>

                <p class="shop-toolbar__count">Showing <span><?= $shopPage->getTotalGames() ?></span> games</p>
                <div class="shop-toolbar__right">
                    <div class="shop-search">
                        <span class="shop-search__icon">&#128269;</span>
                        <input
                            type="search"
                            name="search"
                            class="shop-search__input"
                            placeholder="Search games..."
                            value="<?= Helpers::e($filters['search']) ?>"
                            aria-label="Search games"
                        >
                    </div>
                    <button class="toolbar-submit" type="submit">Search</button>
                    <div class="view-toggle">
                        <button class="view-btn active" type="button" data-view="grid">Grid</button>
                        <button class="view-btn" type="button" data-view="list">List</button>
                    </div>
                </div>
            </form>

            <?php if (empty($games)): ?>
                <div class="shop-empty">
                    <h2>No games found</h2>
                    <p>Try another search or remove some filters.</p>
                </div>
            <?php else: ?>
                <div class="games-grid" id="gamesGrid">
                    <?php Helpers::printGameCards($games); ?>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>

<?php require_once __DIR__ . '/../app/Views/layout/footer.php'; ?>

<script src="assets/js/main.js"></script>
</body>

</html>
