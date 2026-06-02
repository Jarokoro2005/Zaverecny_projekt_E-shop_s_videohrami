<?php include __DIR__ . '/../../parts/header.php'; ?>

<h1>Delete Contact Message</h1>

<?php if (!empty($error)): ?>
    <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<p>Are you sure you want to delete this message?</p>

<p><strong>Name:</strong> <?= htmlspecialchars($message['name']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($message['email']) ?></p>
<p><strong>Topic:</strong> <?= htmlspecialchars($message['topic']) ?></p>

<form method="POST">
    <button type="submit" class="btn btn--danger">Yes, Delete</button>
    <a href="<?= htmlspecialchars($adminUrl . '/contact_messages.php') ?>" class="btn">Cancel</a>
</form>

<?php include __DIR__ . '/../../parts/footer.php'; ?>
