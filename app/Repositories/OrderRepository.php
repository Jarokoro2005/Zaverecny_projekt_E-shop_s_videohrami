<?php

require_once __DIR__ . '/../Core/database.php';

class OrderRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function createOrderWithItems(string $customerName, string $customerEmail, array $items, float $totalPrice): int
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare(
                'INSERT INTO orders (customer_name, customer_email, total_price)
                 VALUES (:customer_name, :customer_email, :total_price)'
            );

            $stmt->execute([
                ':customer_name' => $customerName,
                ':customer_email' => $customerEmail,
                ':total_price' => $totalPrice,
            ]);

            $orderId = (int) $this->pdo->lastInsertId();
            $itemStmt = $this->pdo->prepare(
                'INSERT INTO order_items
                    (order_id, game_id, game_title, quantity, unit_price, total_price)
                 VALUES
                    (:order_id, :game_id, :game_title, :quantity, :unit_price, :total_price)'
            );

            foreach ($items as $item) {
                $game = $item['game'];
                $quantity = (int) $item['quantity'];
                $unitPrice = (float) $game['price'];
                $itemTotal = $unitPrice * $quantity;

                $itemStmt->execute([
                    ':order_id' => $orderId,
                    ':game_id' => (int) $game['id'],
                    ':game_title' => $game['title'],
                    ':quantity' => $quantity,
                    ':unit_price' => $unitPrice,
                    ':total_price' => $itemTotal,
                ]);
            }

            $this->pdo->commit();

            return $orderId;
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}
