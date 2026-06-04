<?php if (!empty($errors)): ?>
    <div class="alert alert--error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <label>Title:
        <input type="text" name="title" value="<?= htmlspecialchars($game['title'] ?? '') ?>" required>
    </label>

    <label>Slug:
        <input type="text" name="slug" value="<?= htmlspecialchars($game['slug'] ?? '') ?>" required>
    </label>

    <label>Description:
        <textarea name="description" rows="6" required><?= htmlspecialchars($game['description'] ?? '') ?></textarea>
    </label>

    <label>Price:
        <input type="number" name="price" step="0.01" min="0" value="<?= htmlspecialchars((string) ($game['price'] ?? '0')) ?>" required>
    </label>

    <label>Original price:
        <input type="number" name="original_price" step="0.01" min="0" value="<?= htmlspecialchars((string) ($game['original_price'] ?? '')) ?>">
    </label>

    <label>Discount percent:
        <input type="number" name="discount_percent" min="0" max="100" value="<?= htmlspecialchars((string) ($game['discount_percent'] ?? '0')) ?>" required>
    </label>

    <label>Image title:
        <input type="text" name="image_title" value="<?= htmlspecialchars($game['image_title'] ?? '') ?>" required>
    </label>

    <label>Image URL:
        <input type="text" name="image_url" value="<?= htmlspecialchars($game['image_url'] ?? '') ?>" required>
    </label>

    <label>Genre:
        <input type="text" name="genre" value="<?= htmlspecialchars($game['genre'] ?? '') ?>" required>
    </label>

    <label>Secondary genre:
        <input type="text" name="secondary_genre" value="<?= htmlspecialchars($game['secondary_genre'] ?? '') ?>">
    </label>

    <label>Rating:
        <input type="number" name="rating" step="0.1" min="0" max="5" value="<?= htmlspecialchars((string) ($game['rating'] ?? '0')) ?>" required>
    </label>

    <label>Age rating:
        <input type="text" name="age_rating" value="<?= htmlspecialchars($game['age_rating'] ?? 'PEGI 12') ?>" required>
    </label>

    <label>Platform:
        <input type="text" name="platform" value="<?= htmlspecialchars($game['platform'] ?? 'PC') ?>" required>
    </label>

    <label>Developer:
        <input type="text" name="developer" value="<?= htmlspecialchars($game['developer'] ?? '') ?>" required>
    </label>

    <label>Publisher:
        <input type="text" name="publisher" value="<?= htmlspecialchars($game['publisher'] ?? '') ?>" required>
    </label>

    <label>Release date:
        <input type="date" name="release_date" value="<?= htmlspecialchars($game['release_date'] ?? '') ?>" required>
    </label>

    <label>Stock:
        <input type="number" name="stock" min="0" value="<?= htmlspecialchars((string) ($game['stock'] ?? '0')) ?>" required>
    </label>

    <label>
        <input type="checkbox" name="is_featured" value="1" <?= !empty($game['is_featured']) ? 'checked' : '' ?>>
        Featured
    </label>

    <label>
        <input type="checkbox" name="is_new_release" value="1" <?= !empty($game['is_new_release']) ? 'checked' : '' ?>>
        New release
    </label>

    <button type="submit" class="btn btn--primary"><?= htmlspecialchars($submitLabel) ?></button>
    <a href="<?= htmlspecialchars($adminUrl . '/games.php') ?>" class="btn">Cancel</a>
</form>
