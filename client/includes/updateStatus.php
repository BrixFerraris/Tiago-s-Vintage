<?php
session_start();
include_once './dbCon.php';

if (isset($_SESSION['uID'])) {
    $userId = $_SESSION['uID'];
    $transactionId = $_POST['transaction_id'];
    $type = $_POST['type'];
    $deduct = isset($_POST['deduct']) ? $_POST['deduct'] : false;

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
            $quantityQuery = $conn->prepare("SELECT SUM(quantity) as total_quantity FROM tbl_transactions WHERE transaction_id = ? AND user_id = ?");
            $quantityQuery->bind_param("si", $transactionId, $userId);
            $quantityQuery->execute();
            $quantityResult = $quantityQuery->get_result();
            $row = $quantityResult->fetch_assoc();
            $totalQuantity = $row['total_quantity'];

            $pointsQuery = $conn->prepare("SELECT points FROM tbl_users WHERE id = ?");
            $pointsQuery->bind_param("i", $userId);
            $pointsQuery->execute();
            $pointsResult = $pointsQuery->get_result();
            $pointsRow = $pointsResult->fetch_assoc();
            $currentPoints = $pointsRow['points'];

            if ($totalQuantity > 0) {
                if ($currentPoints >= 10) {
                    $newPoints = $currentPoints - 10 + $totalQuantity;
                    $updatePointsQuery = $conn->prepare("UPDATE tbl_users SET points = ? WHERE id = ?");
                    $updatePointsQuery->bind_param("ii", $newPoints, $userId);
                    $updatePointsQuery->execute();
                    $updatePointsQuery->close();
                } else {
                    $newPoints = $currentPoints + $totalQuantity;
                    $updatePointsQuery = $conn->prepare("UPDATE tbl_users SET points = ? WHERE id = ?");
                    $updatePointsQuery->bind_param("ii", $newPoints, $userId);
                    $updatePointsQuery->execute();
                    $updatePointsQuery->close();
                }
            }
            $quantityQuery->close();
            $pointsQuery->close();
        }

        echo json_encode(["status" => "success", "message" => "Status updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update status."]);
    }

    $stmt->close();
    $conn->close();

} else {
    echo json_encode(["status" => "error", "message" => "User  not authenticated."]);
}