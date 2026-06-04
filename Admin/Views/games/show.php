<?php include __DIR__ . '/../../parts/header.php'; ?>

<h1>Game Detail</h1>

<p><strong>ID:</strong> <?= (int) $game['id'] ?></p>
<p><strong>Title:</strong> <?= htmlspecialchars($game['title']) ?></p>
<p><strong>Slug:</strong> <?= htmlspecialchars($game['slug']) ?></p>
<p><strong>Description:</strong></p>
<p class="message-body"><?= nl2br(htmlspecialchars($game['description'])) ?></p>
<p><strong>Price:</strong> <?= number_format((float) $game['price'], 2) ?> EUR</p>
<p><strong>Original price:</strong> <?= $game['original_price'] !== null ? number_format((float) $game['original_price'], 2) . ' EUR' : '-' ?></p>
<p><strong>Discount:</strong> <?= (int) $game['discount_percent'] ?>%</p>
<p><strong>Image:</strong> <?= htmlspecialchars($game['image_url']) ?></p>
<p><strong>Genre:</strong> <?= htmlspecialchars($game['genre']) ?></p>
<p><strong>Secondary genre:</strong> <?= htmlspecialchars($game['secondary_genre'] ?? '-') ?></p>
<p><strong>Rating:</strong> <?= number_format((float) $game['rating'], 1) ?>/5</p>
<p><strong>Age rating:</strong> <?= htmlspecialchars($game['age_rating']) ?></p>
<p><strong>Platform:</strong> <?= htmlspecialchars($game['platform']) ?></p>
<p><strong>Developer:</strong> <?= htmlspecialchars($game['developer']) ?></p>
<p><strong>Publisher:</strong> <?= htmlspecialchars($game['publisher']) ?></p>
<p><strong>Release date:</strong> <?= htmlspecialchars($game['release_date']) ?></p>
<p><strong>Stock:</strong> <?= (int) $game['stock'] ?></p>
<p><strong>Featured:</strong> <?= !empty($game['is_featured']) ? 'Yes' : 'No' ?></p>
<p><strong>New release:</strong> <?= !empty($game['is_new_release']) ? 'Yes' : 'No' ?></p>

<a href="<?= htmlspecialchars($adminUrl . '/games.php') ?>" class="btn btn--primary">Back to Games</a>

<?php if (($_SESSION['user_role'] ?? '') === 'admin'): ?>
    <a href="<?= htmlspecialchars($adminUrl . '/games.php?action=edit&id=' . $game['id']) ?>" class="btn">Edit</a>
    <a href="<?= htmlspecialchars($adminUrl . '/games.php?action=delete&id=' . $game['id']) ?>" class="btn btn--danger">Delete</a>
<?php endif; ?>

<?php include __DIR__ . '/../../parts/footer.php'; ?>
