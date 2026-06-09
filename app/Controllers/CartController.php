<?php

class CartController
{
    private GameRepository $games;

    public function __construct()
    {
        $this->games = new GameRepository();
        $this->ensureCart();
    }

    public function index(): array
    {
        $items = [];
        $total = 0;

        foreach ($_SESSION['cart'] as $gameId => $quantity) {
            $game = $this->games->getById((int) $gameId);

            if ($game === null) {
                unset($_SESSION['cart'][$gameId]);
                continue;
            }

            $price = (float) $game['price'];
            $quantity = (int) $quantity;
            $subtotal = $price * $quantity;
            $total += $subtotal;

            $items[] = [
                'game' => $game,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        return [
            'items' => $items,
            'total' => $total,
        ];
    }

    public function ifEmpty(): bool
    {
        return empty($_SESSION['cart']);
    }

    public function add(int $productId): bool
    {
        $this->ensureCart();

        if ($this->games->getById($productId) === null) {
            return false;
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]++;
        } else {
            $_SESSION['cart'][$productId] = 1;
        }

        return true;
    }

    public function update(int $productId, int $quantity): void
    {
        $this->ensureCart();

        if ($quantity <= 0) {
            $this->remove($productId);
            return;
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    public function remove(int $productId): void
    {
        $this->ensureCart();
        unset($_SESSION['cart'][$productId]);
    }

    public function clear(): void
    {
        $_SESSION['cart'] = [];
    }

    public static function countItems(): int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            return 0;
        }

        return array_sum(array_map('intval', $_SESSION['cart']));
    }

    private function ensureCart(): void
    {
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }
}


