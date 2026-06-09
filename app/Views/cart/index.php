<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container" style="padding: 3rem 0 5rem;">
    <div class="page-header" style="padding-top: 0;">
        <p class="page-header__eyebrow">// Session cart</p>
        <h1 class="page-header__title">Shopping <span>Cart</span></h1>
    </div>

    <?php if (empty($items)): ?>
        <div class="shop-empty">
            <h2><?= $orderId !== null ? 'Order created' : 'Your cart is empty' ?></h2>
            <p>
                <?= $orderId !== null
                    ? 'Thank you. Your order number is #' . (int) $orderId . '.'
                    : 'Add a game from the store detail page.' ?>
            </p>
            <a class="btn btn-magenta" href="shop.php">Back to shop</a>
        </div>
    <?php else: ?>
        <?php if (!empty($errors)): ?>
            <div class="form-feedback error" style="margin-bottom: 1rem;">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= Helpers::e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div style="display: grid; gap: 1rem;">
            <?php foreach ($items as $item): ?>
                <?php $game = $item['game']; ?>
                <div class="card" style="padding: 1rem; display: flex; justify-content: space-between; gap: 1rem; align-items: center;">
                    <div>
                        <h2 style="font-size: 1rem; margin-bottom: .25rem;">
                            <?= Helpers::e($game['title']) ?>
                        </h2>
                        <p style="color: var(--muted);">
                            Quantity: <?= (int) $item['quantity'] ?> |
                            Price: <?= Helpers::formatPrice((float) $game['price']) ?> |
                            Subtotal: <?= Helpers::formatPrice((float) $item['subtotal']) ?>
                        </p>
                    </div>

                    <div style="display: flex; gap: .5rem; align-items: center;">
                        <form method="post" action="cart_action.php" style="display: flex; gap: .5rem;">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="game_id" value="<?= (int) $game['id'] ?>">
                            <input class="form-control" style="width: 80px;" type="number" name="quantity" min="1" value="<?= (int) $item['quantity'] ?>">
                            <button class="btn" type="submit">Update</button>
                        </form>

                        <form method="post" action="cart_action.php">
                            <input type="hidden" name="action" value="remove">
                            <input type="hidden" name="game_id" value="<?= (int) $game['id'] ?>">
                            <button class="btn btn-magenta" type="submit">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <h2>Total: <?= Helpers::formatPrice((float) $total) ?></h2>

            <form method="post" action="cart_action.php">
                <input type="hidden" name="action" value="clear">
                <button class="btn btn-magenta" type="submit">Clear cart</button>
            </form>
        </div>

        <div class="card" style="margin-top: 2rem; padding: 1.5rem;">
            <h2 style="font-size: 1.1rem; margin-bottom: 1rem;">Checkout</h2>

            <form method="post" action="cart_action.php" style="display: grid; gap: 1rem;">
                <input type="hidden" name="action" value="checkout">

                <div class="form-group">
                    <label class="form-label" for="customer-name">Name</label>
                    <input
                        class="form-control"
                        id="customer-name"
                        type="text"
                        name="customer_name"
                        value="<?= Helpers::e($old['customer_name'] ?? '') ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="customer-email">Email</label>
                    <input
                        class="form-control"
                        id="customer-email"
                        type="email"
                        name="customer_email"
                        value="<?= Helpers::e($old['customer_email'] ?? '') ?>"
                        required
                    >
                </div>

                <button class="btn btn-solid" type="submit" style="justify-content: center;">Create order</button>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>

<script src="assets/js/main.js"></script>
</body>

</html>
