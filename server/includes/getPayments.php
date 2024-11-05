<?php
include_once './dbCon.php';

$transactionId = $_GET['transaction_number'];

$sql = "SELECT * FROM tbl_payments WHERE transaction_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $transactionId);
$stmt->execute();
$result = $stmt->get_result();

$payments = [];
while ($row = $result->fetch_assoc()) {
    $payments[] = $row;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($payments);