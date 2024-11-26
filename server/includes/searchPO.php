<?php
require './dbCon.php';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "SELECT t.*, p.*, u.firstName, u.lastName, u.id, u.username, u.points, u.contact 
        FROM tbl_transactions t 
        INNER JOIN tbl_products p ON t.product_id = p.id 
        INNER JOIN tbl_users u ON t.user_id = u.id 
        WHERE t.status = ?"; 

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $status);
$stmt->execute();
$result = $stmt->get_result();

$orderItems = [];
$total = 0;
$name = '';
$address = '';
$contact = '';
$id = '';
$status = '';
$username = '';
$points = '';
$discount = 0;
$shipping = 0;

while ($row = $result->fetch_assoc()) {
    $orderItems[] = $row; 
    $total += $row['total']; 
    $name = $row["firstName"] . " " . $row["lastName"];
    $address = $row["address"];
    $contact = $row["contact"];
    $id = $row["id"];
    $status = $row["status"];
    $username = $row["username"];
    $points = $row["points"];
}

$response = [
    'order_items' => $orderItems,
    'order_total' => $total,
    'name' => $name,
    'address' => $address,
    'contact' => $contact,
    'id' => $id,
    'status' => $status,
    'username' => $username,
    'points' => $points 
];

header('Content-Type: application/json');
echo json_encode($response); 
$stmt->close();
$conn->close();