<?php

class ContactController extends BaseController
{
    private ContactRepository $repo;

    public function __construct()
    {
        $this->repo = new ContactRepository();
    }

    public function listMessages(): void
    {
        $this->requireLogin();
        $messages = $this->repo->getAll();
        $this->render('contacts/index.php', [
            'messages' => $messages,
            'deleted' => $_GET['deleted'] ?? null,
        ]);
    }

    public function detail(int $id): void
    {
        $this->requireLogin();
        $message = $this->repo->getById($id);

        if (!$message) {
            die('Message not found');
        }

        $this->render('contacts/show.php', ['message' => $message]);
    }

    public function edit(int $id, array $input): void
    {
        $this->requireAdmin();

        $message = $this->repo->getById($id);
        if (!$message) {
            die('Message not found');
        }

        $errors = [];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($input['name'] ?? '');
            $email = trim($input['email'] ?? '');
            $topic = trim($input['topic'] ?? '');
            $messageText = trim($input['message'] ?? '');
            $newsletter = isset($input['newsletter']) ? 1 : 0;

            if ($name === '') {
                $errors[] = 'Name is required.';
            }
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Valid email is required.';
            }
            if ($topic === '') {
                $errors[] = 'Topic is required.';
            }
            if ($messageText === '') {
                $errors[] = 'Message is required.';
            }

            if (empty($errors)) {
                if ($this->repo->updateContact($id, $name, $email, $topic, $messageText, $newsletter)) {
                    $success = true;
                    $message = $this->repo->getById($id);
                } else {
                    $errors[] = 'Failed to update message.';
                }
            }
        }

        $this->render('contacts/edit.php', [
            'message' => $message,
            'errors' => $errors,
            'success' => $success,
        ]);
    }

    public function delete(int $id, array $input): void
    {
        $this->requireAdmin();

        $message = $this->repo->getById($id);
        if (!$message) {
            die('Message not found');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->repo->deleteContact($id)) {
                $this->redirect($this->adminUrl('contact_messages.php?deleted=1'));
                return;
            }
            $error = 'Failed to delete message.';
        }

        $this->render('contacts/delete.php', [
            'message' => $message,
            'error' => $error,
        ]);
    }

    public function markSeen(int $id, array $input): void
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect($this->adminUrl('contact_messages.php'));
        }

        $seen = isset($input['seen']) && $input['seen'] === '1' ? 1 : 0;
        $this->repo->updateSeen($id, $seen);

        $back = $input['back'] ?? $this->adminUrl('contact_messages.php');
        $this->redirect($back);
    }
}
