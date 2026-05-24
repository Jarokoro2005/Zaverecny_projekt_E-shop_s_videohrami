<?php include __DIR__ . '/../parts/header.php'; ?>

<h1>Admin Dashboard</h1>
<p>Welcome, <?= htmlspecialchars($_SESSION['admin_username'] ?? '') ?>! (Role:
    <?= htmlspecialchars($_SESSION['user_role'] ?? '') ?>)</p>

<ul>
    <li><a href="contact_messages.php">Contact Messages</a></li>
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
        <li><a href="add_user.php">Add User</a></li>
    <?php endif; ?>
    <li><a href="logout.php">Logout</a></li>
</ul>

<?php include __DIR__ . '/../parts/footer.php'; ?>
