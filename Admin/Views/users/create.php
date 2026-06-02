<?php include __DIR__ . '/../../parts/header.php'; ?>

<h1>Add Admin / Employee</h1>

<?php if (!empty($success)): ?>
    <div class="alert alert--success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" class="form-admin">
    <label>Username:
        <input type="text" name="username" value="<?= htmlspecialchars($input['username'] ?? '') ?>" required>
    </label>

    <label>Password:
        <input type="password" name="password" placeholder="Password" required>
    </label>

    <label>Role:
        <select name="role" required>
            <option value="">Select role</option>
            <option value="admin" <?= isset($input['role']) && $input['role'] === 'admin' ? 'selected' : '' ?>>Admin
            </option>
            <option value="employee" <?= isset($input['role']) && $input['role'] === 'employee' ? 'selected' : '' ?>>
                Employee</option>
        </select>
    </label>

    <button type="submit" class="btn btn--primary">Create User</button>
</form>

<?php include __DIR__ . '/../../parts/footer.php'; ?>
