<?php

require_once __DIR__ . '/../Repositories/ContactRepository.php';

class ContactController
{
    private ContactRepository $repo;
    private array $errors = [];

    public function __construct()
    {
        $this->repo = new ContactRepository();
    }

    public function submit(array $data): bool
    {
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $topic = trim($data['topic'] ?? '');
        $message = trim($data['message'] ?? '');
        $newsletter = isset($data['newsletter']) ? 1 : 0;

        $this->errors = [];

        if ($name === '') {
            $this->errors[] = 'Name is required.';
        }
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Please enter a valid email address.';
        }
        if ($topic === '') {
            $this->errors[] = 'Please select a topic.';
        }
        if ($message === '') {
            $this->errors[] = 'Message is required.';
        }

        if (!empty($this->errors)) {
            return false;
        }

        if (!$this->repo->createContact($name, $email, $topic, $message, $newsletter)) {
            $this->errors[] = 'Failed to send message. Please try again.';
            return false;
        }

        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
