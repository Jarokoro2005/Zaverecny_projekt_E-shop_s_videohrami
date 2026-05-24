<?php

abstract class BaseController
{
    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        require __DIR__ . '/../Views/' . $view;
    }

    protected function redirect(string $path): void
    {
        header("Location: $path");
        exit;
    }

    protected function requireLogin(): void
    {
        if (empty($_SESSION['admin_logged_in'])) {
            $this->redirect('login.php');
        }
    }

    protected function requireAdmin(): void
    {
        $this->requireLogin();
        if (($_SESSION['user_role'] ?? '') !== 'admin') {
            $this->redirect('index.php');
        }
    }
}
