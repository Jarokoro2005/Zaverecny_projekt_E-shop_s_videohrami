<?php

class AuthController extends BaseController
{
    private AdminUserRepository $repo;

    public function __construct()
    {
        $this->repo = new AdminUserRepository();
    }

    public function showLogin(string $error = ''): void
    {
        if (!empty($_SESSION['admin_logged_in'])) {
            $this->redirect('index.php');
        }

        $this->render('auth/login.php', ['error' => $error]);
    }

    public function login(array $input): void
    {
        $username = trim($input['username'] ?? '');
        $password = trim($input['password'] ?? '');

        if ($username === '' || $password === '') {
            $this->showLogin('Please enter both username and password.');
            return;
        }

        $user = $this->repo->getByUsername($username);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['user_role'] = $user['role'] ?? 'admin';
            $this->redirect('index.php');
            return;
        }

        $this->showLogin('Invalid username or password.');
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        $this->redirect('login.php');
    }
}
