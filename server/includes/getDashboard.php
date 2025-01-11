<?php
header('Content-Type: application/json');
include_once './dbCon.php';

$sql = "
    SELECT 
        (SELECT COUNT(DISTINCT transaction_id) FROM tbl_transactions WHERE status = 'Completed' AND shipping = 'delivery') AS completed_delivery,
        (SELECT COUNT(DISTINCT transaction_id) FROM tbl_transactions WHERE status = 'Completed'AND shipping = 'pickup') AS completed_pickup,
        (SELECT COUNT(DISTINCT id) FROM tbl_products) AS unique_products,
        (SELECT COUNT(*) FROM tbl_variations WHERE quantity < 5) AS low_stock_variations;
";

$result = $conn->query($sql);

if ($result) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(['error' => $conn->error]);
}
$conn->close();