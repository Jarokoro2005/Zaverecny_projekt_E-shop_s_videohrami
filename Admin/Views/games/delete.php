<?php include __DIR__ . '/../../parts/header.php'; ?>

<h1>Delete Game</h1>

<?php if (!empty($error)): ?>
    <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<p>Are you sure you want to delete this game?</p>

<p><strong>Title:</strong> <?= htmlspecialchars($game['title']) ?></p>
<p><strong>Genre:</strong> <?= htmlspecialchars($game['genre']) ?></p>
<p><strong>Price:</strong> <?= number_format((float) $game['price'], 2) ?> EUR</p>

<form method="POST">
    <button type="submit" class="btn btn--danger">Yes, Delete</button>
    <a href="<?= htmlspecialchars($adminUrl . '/games.php') ?>" class="btn">Cancel</a>
</form>

<?php include __DIR__ . '/../../parts/footer.php'; ?>
