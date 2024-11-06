<?php
session_start();
include 'dbCon.php'; 

$user_id = $_SESSION['uID'];

$sql = "
SELECT t.*, 
       p.title, p.category, p.img1, p.description, 
       u.firstName, u.lastName, u.contact, 
       v.variationName, v.width, v.length
FROM tbl_transactions t 
INNER JOIN tbl_products p ON t.product_id = p.id 
INNER JOIN tbl_users u ON t.user_id = u.id 
INNER JOIN tbl_variations v ON t.variation_id = v.id 
WHERE t.user_id = ? AND t.status = 'Pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $transaction_id = $row['transaction_id'];
    if (!isset($orders[$transaction_id])) {
        $orders[$transaction_id] = [
            'transaction_id' => $transaction_id,
            'items' => [],
            'status' => $row['status'], 
            'total_quantity' => 0,
            'total_price' => 0, 
            'first_img' => $row['img1'], 
            'first_size' => $row['width'] . 'W X ' . $row['length'] . 'L',
            'tId' => $row['id']
        ];
    }
    
    $orders[$transaction_id]['items'][] = [
        'title' => $row['title'],
        'quantity' => $row['quantity'],
        'price' => $row['total'], 
        'variationName' => $row['variationName'],
        'size' => $row['width'] . 'W X ' . $row['length'] . " (" . $row['variationName'] . ") "
    ];
    
    $orders[$transaction_id]['total_quantity'] += $row['quantity'];
    $orders[$transaction_id]['total_price'] += $row['quantity'] * $row['total'];
}

$stmt->close();
$conn->close();
header('Content-Type: application/json');
echo json_encode(array_values($orders));