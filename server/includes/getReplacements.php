<?php
session_start();
include_once './dbCon.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$transactionId = $_POST['transaction_id'] ?? null;

if (!$transactionId) {
    echo json_encode(["status" => "error", "message" => "No transaction ID provided."]);
    exit;
}

$query = $conn->prepare("SELECT * FROM tbl_replacements WHERE transaction_id = ?");
$query->bind_param("s", $transactionId);

if ($query->execute()) {
    $result = $query->get_result();
    $replacements = [];

    while ($row = $result->fetch_assoc()) {
        $replacements[] = $row;
    }

    echo json_encode(["status" => "success", "data" => $replacements]);
} else {
    error_log("Failed to fetch replacements: " . $query->error);
    echo json_encode(["status" => "error", "message" => "Failed to fetch replacements."]);
}

$query->close();
$conn->close();
