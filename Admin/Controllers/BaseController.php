<?php

abstract class BaseController
{
    protected function render(string $view, array $data = []): void
    {
        $adminUrl = $this->adminUrl();
        $publicUrl = $this->publicUrl();
        extract($data, EXTR_SKIP);
        require __DIR__ . '/../Views/' . $view;
    }

    protected function redirect(string $path): void
    {
        header("Location: $path");
        exit;
    }

    protected function adminUrl(string $path = ''): string
    {
        return $this->baseUrl('Admin', $path);
    }

    protected function publicUrl(string $path = ''): string
    {
        return $this->baseUrl('public', $path);
    }

    private function baseUrl(string $section, string $path = ''): string
    {
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
        $projectUrl = preg_replace('#/(Admin|public)$#', '', $scriptDir);

        return rtrim((string) $projectUrl, '/') . '/' . trim($section . '/' . ltrim($path, '/'), '/');
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
