<?php

class UserController extends BaseController
{
    private AdminUserRepository $repo;

    public function __construct()
    {
        $this->repo = new AdminUserRepository();
    }

    public function add(array $input): void
    {
        $this->requireAdmin();

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($input['username'] ?? '');
            $password = trim($input['password'] ?? '');
            $role = trim($input['role'] ?? '');

            if ($username === '' || $password === '' || !in_array($role, ['admin', 'employee'], true)) {
                $error = 'Please enter a username, password, and choose a valid role.';
            } else {
                try {
                    if ($this->repo->createUser($username, $password, $role)) {
                        $success = "User '$username' added successfully as '$role'.";
                    } else {
                        $error = 'Unable to add user. Please try again.';
                    }
                } catch (PDOException $e) {
                    if (isset($e->errorInfo[1]) && $e->errorInfo[1] === 1062) {
                        $error = 'That username is already taken.';
                    } else {
                        $error = 'Unable to add user. Please try again.';
                    }
                }
            }
        }

        $this->render('users/create.php', [
            'error' => $error,
            'success' => $success,
            'input' => $input,
        ]);
    }
}
