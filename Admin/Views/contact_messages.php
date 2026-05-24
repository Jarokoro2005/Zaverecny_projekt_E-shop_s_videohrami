<?php include __DIR__ . '/../parts/header.php'; ?>

<h1>Contact Messages</h1>

<?php if (!empty($deleted)): ?>
    <div class="alert alert--success">Message deleted successfully!</div>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Topic</th>
        <th>Seen</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($messages as $m): ?>
        <tr>
            <td><?= $m['id'] ?></td>
            <td><?= htmlspecialchars($m['name']) ?></td>
            <td><?= htmlspecialchars($m['email']) ?></td>
            <td><?= htmlspecialchars($m['topic']) ?></td>
            <td><?= !empty($m['seen']) ? 'Yes' : 'No' ?></td>
            <td>
                <a href="/testlen/Admin/contact_detail.php?id=<?= $m['id'] ?>">View</a>
                <form method="POST" action="/testlen/Admin/contact_seen.php?id=<?= $m['id'] ?>" class="table-action-form">
                    <input type="hidden" name="seen" value="<?= !empty($m['seen']) ? '0' : '1' ?>">
                    <button type="submit" class="btn">
                        <?= !empty($m['seen']) ? 'Mark unseen' : 'Mark seen' ?>
                    </button>
                </form>
                <?php if (($_SESSION['user_role'] ?? '') === 'admin'): ?>
                    | <a href="/testlen/Admin/contact_edit.php?id=<?= $m['id'] ?>">Edit</a> |
                    <a href="/testlen/Admin/contact_delete.php?id=<?= $m['id'] ?>"
                        onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../parts/footer.php'; ?>
