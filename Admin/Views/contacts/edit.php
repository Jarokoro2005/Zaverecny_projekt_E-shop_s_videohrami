<?php include __DIR__ . '/../../parts/header.php'; ?>

<h1>Edit Contact Message</h1>

<?php if ($success): ?>
    <div class="alert alert--success">Message updated successfully!</div>
<?php endif; ?>

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
    <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($message['name'] ?? '') ?>"
            required></label><br>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($message['email'] ?? '') ?>"
            required></label><br>
    <label>Topic: <input type="text" name="topic" value="<?= htmlspecialchars($message['topic'] ?? '') ?>"
            required></label><br>
    <label>Message:<br>
        <textarea name="message" rows="5" required><?= htmlspecialchars($message['message'] ?? '') ?></textarea>
    </label><br>
    <label>Newsletter: <input type="checkbox" name="newsletter" value="1" <?= !empty($message['newsletter']) ? 'checked' : '' ?>></label><br>
    <button type="submit" class="btn btn--primary">Update</button>
</form>

<a href="<?= htmlspecialchars($adminUrl . '/contacts.php') ?>" class="btn">Back to Messages</a>

<?php include __DIR__ . '/../../parts/footer.php'; ?>
