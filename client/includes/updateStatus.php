<?php
session_start();
include_once './dbCon.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$userId = $_SESSION['uID'];
$transactionId = $_POST['transaction_id'];
$type = $_POST['type'];
$points = $_POST['points'];
if (isset($_SESSION['uID'])) {

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
            // Fetch total quantity for the transaction
            $quantityQuery = $conn->prepare("SELECT SUM(quantity) as total_quantity FROM tbl_transactions WHERE transaction_id = ? AND user_id = ?");
            $quantityQuery->bind_param("si", $transactionId, $userId);
            $quantityQuery->execute();
            $quantityResult = $quantityQuery->get_result();
            $row = $quantityResult->fetch_assoc();
            $totalQuantity = intval($row['total_quantity'] ?? 0); // Default to 0 if null
            $quantityQuery->close();

            // Fetch current points for the user
            $pointsQuery = $conn->prepare("SELECT points FROM tbl_users WHERE id = ?");
            $pointsQuery->bind_param("i", $userId);
            $pointsQuery->execute();
            $pointsResult = $pointsQuery->get_result();
            $pointsRow = $pointsResult->fetch_assoc();
            $currentPoints = intval($points); // Default to 0 if null
            $pointsQuery->close();

            // Debug current values
            error_log("Transaction ID: $transactionId, User ID: $userId");
            error_log("Current Points: $currentPoints");
            error_log("Total Quantity: $totalQuantity");

            // Calculate new points
            if ($currentPoints > 0) {
                // Deduct 10 points and add total quantity
                $currentPoints -= 10;
                $newPoints = $currentPoints + $totalQuantity;
                error_log("Deducting 10 points. New Points: $newPoints");
                // Update points in tbl_users
                $updatePointsQuery = $conn->prepare("UPDATE tbl_users SET points = ? WHERE id = ?");
                $updatePointsQuery->bind_param("ii", $newPoints, $userId);
                if ($updatePointsQuery->execute()) {
                    error_log("Points updated successfully. New Points: $newPoints");
                } else {
                    error_log("Failed to update points: " . $updatePointsQuery->error);
                }
                $updatePointsQuery->close();
            } else {
                // Just add total quantity if current points are less than 10
                $newPoints = $currentPoints + $totalQuantity;
                error_log("No deduction. Adding total quantity only. New Points: $newPoints");
                // Update points in tbl_users
                $updatePointsQuery = $conn->prepare("UPDATE tbl_users SET points = ? WHERE id = ?");
                $updatePointsQuery->bind_param("ii", $newPoints, $userId);
                if ($updatePointsQuery->execute()) {
                    error_log("Points updated successfully. New Points: $newPoints");
                } else {
                    error_log("Failed to update points: " . $updatePointsQuery->error);
                }
                $updatePointsQuery->close();
            }
        }
        echo json_encode($points);
    } else {
        error_log("Failed to update transaction status: " . $stmt->error);
        echo json_encode(["status" => "error", "message" => "Failed to update status."]);
    }

} else {
    echo json_encode(["status" => "error", "message" => "User  not authenticated."]);
}