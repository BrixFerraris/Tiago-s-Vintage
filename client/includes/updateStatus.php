<?php
session_start();
include_once './dbCon.php';
if (isset($_SESSION['uID'])) {
    $userId = $_SESSION['uID'];
    $transactionId = $_POST['transaction_id'];
    $stmt = $conn->prepare("UPDATE tbl_transactions SET status = 'Check Payment' WHERE transaction_id = ? AND user_id = ?");
    $stmt->bind_param("si", $transactionId, $userId); 
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