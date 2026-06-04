<?php include __DIR__ . '/../../parts/header.php'; ?>

<h1>Admin Dashboard</h1>
<p>Welcome, <?= htmlspecialchars($_SESSION['admin_username'] ?? '') ?>! (Role:
    <?= htmlspecialchars($_SESSION['user_role'] ?? '') ?>)</p>

<ul>
    <li><a href="<?= htmlspecialchars($adminUrl . '/contacts.php') ?>">Contact Messages</a></li>
    <li><a href="<?= htmlspecialchars($adminUrl . '/games.php') ?>">Games</a></li>
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
        <li><a href="<?= htmlspecialchars($adminUrl . '/add_user.php') ?>">Add User</a></li>
    <?php endif; ?>
    <li><a href="<?= htmlspecialchars($adminUrl . '/logout.php') ?>">Logout</a></li>
</ul>

<?php include __DIR__ . '/../../parts/footer.php'; ?>

