<?php
session_start();
include 'dbCon.php'; 

$user_id = $_SESSION['uID'];

$sql = "
SELECT t.*, 
       p.title, p.category, p.img1, p.description, 
       u.firstName, u.lastName, u.contact, u.points,
       v.variationName, v.width, v.length, v.id AS variation_ID
FROM tbl_transactions t 
INNER JOIN tbl_products p ON t.product_id = p.id 
INNER JOIN tbl_users u ON t.user_id = u.id 
INNER JOIN tbl_variations v ON t.variation_id = v.id 
WHERE t.user_id = ?";
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
            'reason' => $row['reason'],
            'total_quantity' => 0,
            'total_price' => 0, 
            'first_img' => $row['img1'], 
            'first_size' => $row['width'] . 'W X ' . $row['length'] . 'L',
            'tId' => $row['id'],
            'discount' => $row['discount'],
            'shipping' => $row['shipping'],
            'points' => $row['points'],
            'grandtotal' => $row['grand_total'],
            'title' => $row['title'],
            'variationName' => $row['variationName'],
            'reviewed' => $row['reviewed']
        ];
    }
    
    $orders[$transaction_id]['items'][] = [
        'title' => $row['title'],
        'quantity' => $row['quantity'],
        'price' => $row['total'], 
        'variationName' => $row['variationName'],
        'size' => $row['width'] . 'W X ' . $row['length'] . " (" . $row['variationName'] . ") ",
        'variationID' => $row['variation_ID']
    ];
    
    $orders[$transaction_id]['total_quantity'] += $row['quantity'];
    $orders[$transaction_id]['total_price'] += $row['total'];
}

$stmt->close();
$conn->close();
header('Content-Type: application/json');
echo json_encode(array_values($orders));