<?php include __DIR__ . '/../../parts/header.php'; ?>

<div style="max-width: 400px; margin: 4rem auto; text-align: center;">
    <h1>Admin Login</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Username: <input type="text" name="username" placeholder="Username" required></label>
        <label>Password: <input type="password" name="password" placeholder="Password" required></label>
        <button type="submit" class="btn btn--primary">Login</button>
    </form>
</div>

<?php include __DIR__ . '/../../parts/footer.php'; ?>
