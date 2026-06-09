<?php

class CheckoutController
{
    private CartController $cart;
    private OrderRepository $orders;
    private array $errors = [];

    public function __construct()
    {
        $this->cart = new CartController();
        $this->orders = new OrderRepository();
    }

    public function submit(array $data): ?int
    {
        $name = trim($data['customer_name'] ?? '');
        $email = trim($data['customer_email'] ?? '');
        $cart = $this->cart->index();

        $this->errors = [];

        if ($name === '') {
            $this->errors[] = 'Name is required.';
        }

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Please enter a valid email address.';
        }

        if (empty($cart['items'])) {
            $this->errors[] = 'Cart is empty.';
        }

        if (!empty($this->errors)) {
            return null;
        }

        try {
            $orderId = $this->orders->createOrderWithItems($name, $email, $cart['items'], (float) $cart['total']);
            $this->cart->clear();

            return $orderId;
        } catch (Throwable $e) {
            $this->errors[] = 'Order could not be created. Please try again.';
            return null;
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
