<?php
session_start();
include_once './dbCon.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$userId = $_SESSION['uID'];
$transactionId = $_POST['transaction_id'] ?? null; 
$type = $_POST['type'] ?? null; 

if (!isset($userId)) {
    echo json_encode(["status" => "error", "message" => "User  not authenticated."]);
    exit;
}

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
    if ($type === 'complete') {
        $countQuery = $conn->prepare("SELECT COUNT(*) as completed_count FROM tbl_transactions WHERE transaction_id = ? AND user_id = ? AND status = 'Completed'");
        $countQuery->bind_param("si", $transactionId, $userId);
        $countQuery->execute();
        $countResult = $countQuery->get_result();
        $row = $countResult->fetch_assoc();
        $completedCount = intval($row['completed_count'] ?? 0);
        $countQuery->close();

        if ($completedCount > 0) {
            $pointsQuery = $conn->prepare("UPDATE tbl_users SET points = ? WHERE id = ?");
            $pointsQuery->bind_param("ii", $completedCount, $userId);
            
            if ($pointsQuery->execute()) {
                error_log("Points updated successfully. Added Points: $completedCount");
                echo json_encode(["status" => "success", "message" => "Points updated successfully."]);
            } else {
                error_log("Failed to update points: " . $pointsQuery->error);
                echo json_encode(["status" => "error", "message" => "Failed to update points."]);
            }
            $pointsQuery->close();
        } else {
            echo json_encode(["status" => "info", "message" => "No completed transactions found."]);
        }
    } else {
        echo json_encode(["status" => "success", "message" => "Transaction status updated."]);
    }
} else {
    error_log("Failed to update transaction status: " . $stmt->error);
    echo json_encode(["status" => "error", "message" => "Failed to update status."]);
}

$stmt->close();
$conn->close();