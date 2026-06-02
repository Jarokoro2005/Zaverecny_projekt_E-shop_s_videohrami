<?php include __DIR__ . '/../../parts/header.php'; ?>

<h1>Contact Message Detail</h1>

<p><strong>ID:</strong> <?= $message['id'] ?></p>
<p><strong>Name:</strong> <?= htmlspecialchars($message['name']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($message['email']) ?></p>
<p><strong>Topic:</strong> <?= htmlspecialchars($message['topic']) ?></p>
<p><strong>Message:</strong></p>
<p class="message-body"><?= nl2br(htmlspecialchars($message['message'])) ?></p>
<p><strong>Newsletter:</strong> <?= $message['newsletter'] ? 'Yes' : 'No' ?></p>
<p><strong>Seen:</strong> <?= !empty($message['seen']) ? 'Yes' : 'No' ?></p>

<form method="POST" action="<?= htmlspecialchars($adminUrl . '/contacts.php?action=seen&id=' . $message['id']) ?>" class="table-action-form">
    <input type="hidden" name="seen" value="<?= !empty($message['seen']) ? '0' : '1' ?>">
    <input type="hidden" name="back" value="<?= htmlspecialchars($adminUrl . '/contacts.php?action=show&id=' . $message['id']) ?>">
    <button type="submit" class="btn">
        <?= !empty($message['seen']) ? 'Mark unseen' : 'Mark seen' ?>
    </button>
</form>

<a href="<?= htmlspecialchars($adminUrl . '/contacts.php') ?>" class="btn btn--primary">Back to Messages</a>

<?php if (($_SESSION['user_role'] ?? '') === 'admin'): ?>
    <a href="<?= htmlspecialchars($adminUrl . '/contacts.php?action=edit&id=' . $message['id']) ?>" class="btn">Edit</a>
    <a href="<?= htmlspecialchars($adminUrl . '/contacts.php?action=delete&id=' . $message['id']) ?>" class="btn btn--danger"
        onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
<?php endif; ?>

<?php include __DIR__ . '/../../parts/footer.php'; ?>
