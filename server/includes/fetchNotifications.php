<?php
require_once 'dbCon.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conn->prepare("
    SELECT 
        t.*, 
        u.username, 
        p.*
    FROM tbl_transactions t
    INNER JOIN tbl_users u ON t.user_id = u.id
    INNER JOIN tbl_products p ON t.product_id = p.id
    WHERE t.seen = 'false'
    ORDER BY t.date DESC
");
    $stmt->execute();
    $result = $stmt->get_result();

    $notifications = [];
    $uniqueTransactions = [];

    while ($row = $result->fetch_assoc()) {
        if (!in_array($row['transaction_id'], $uniqueTransactions)) {
            $uniqueTransactions[] = $row['transaction_id'];
            $notifications[] = [
                'transaction_id' => $row['transaction_id'],
                'status' => $row['status'],
                'username' => $row['username'],
                'title' => $row['title'],
                'product_id' => $row['product_id']
            ];
        }
    }

    $stmt2 = $conn->prepare("
        SELECT 
            v.product_id,
            v.id,
            v.quantity, 
            v.variationName AS variant,
            p.title AS product_name
        FROM tbl_variations v
        INNER JOIN tbl_products p ON v.product_id = p.id
        WHERE v.quantity < 5 AND v.seen = 'false'
    ");
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    while ($row = $result2->fetch_assoc()) {
        $notifications[] = [
            'status' => 'Low Stock',
            'product_name' => $row['product_name'],
            'quantity' => $row['quantity'],
            'product_id' => $row['product_id'],
            'variant' => $row['variant'],
            'variation_id' => $row['id']
        ];
    }

    echo json_encode($notifications);
    $stmt->close();
    $stmt2->close();
}