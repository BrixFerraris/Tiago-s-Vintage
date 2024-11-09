<?php
session_start();
include_once './dbCon.php';
if (isset($_SESSION['uID'])) {
    $userId = $_SESSION['uID'];
    $transactionId = $_POST['transaction_id'];
    $type = $_POST['type'];
    if ($type === 'payment') {
        $status = 'Check Payment';
    } elseif ($type === 'complete') {
        $status = 'Completed';
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid type specified."]);
        exit; 
    }
    $stmt = $conn->prepare("UPDATE tbl_transactions SET status = ? WHERE transaction_id = ? AND user_id = ?");
    $stmt->bind_param("ssi", $status, $transactionId, $userId); 
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Status updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update status."]);
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "User  not authenticated."]);
}