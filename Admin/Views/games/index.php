<?php include __DIR__ . '/../../parts/header.php'; ?>

<h1>Games</h1>

<?php if (!empty($created)): ?>
    <div class="alert alert--success">Game created successfully!</div>
<?php endif; ?>

<?php if (!empty($updated)): ?>
    <div class="alert alert--success">Game updated successfully!</div>
<?php endif; ?>

<?php if (!empty($deleted)): ?>
    <div class="alert alert--success">Game deleted successfully!</div>
<?php endif; ?>

<?php if (($_SESSION['user_role'] ?? '') === 'admin'): ?>
    <a href="<?= htmlspecialchars($adminUrl . '/games.php?action=create') ?>" class="btn btn--primary">Add Game</a>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Genre</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Featured</th>
        <th>New</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($games as $game): ?>
        <tr>
            <td><?= (int) $game['id'] ?></td>
            <td><?= htmlspecialchars($game['title']) ?></td>
            <td><?= htmlspecialchars($game['genre']) ?></td>
            <td><?= number_format((float) $game['price'], 2) ?> EUR</td>
            <td><?= (int) $game['stock'] ?></td>
            <td><?= !empty($game['is_featured']) ? 'Yes' : 'No' ?></td>
            <td><?= !empty($game['is_new_release']) ? 'Yes' : 'No' ?></td>
            <td>
                <a href="<?= htmlspecialchars($adminUrl . '/games.php?action=show&id=' . $game['id']) ?>">View</a>
                <?php if (($_SESSION['user_role'] ?? '') === 'admin'): ?>
                    | <a href="<?= htmlspecialchars($adminUrl . '/games.php?action=edit&id=' . $game['id']) ?>">Edit</a> |
                    <a href="<?= htmlspecialchars($adminUrl . '/games.php?action=delete&id=' . $game['id']) ?>">Delete</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../../parts/footer.php'; ?>
