<?php
include_once './dbCon.php';

if (isset($_POST['transaction_id']) && isset($_POST['action'])) {
    $transactionId = $_POST['transaction_id'];
    $action = $_POST['action'];
    
    if ($action === 'accept') {
        $status = 'Ready For Pickup';
    } elseif ($action === 'complete') {
        $status = 'Completed'; 
    } elseif ($action === 'decline') {
        $status = 'Cancelled';
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE tbl_transactions SET status = ? WHERE transaction_id = ?");
    $stmt->bind_param('si', $status, $transactionId); 

    if ($stmt->execute()) {
        if ($action === 'complete') {
            $quantityQuery = $conn->prepare("SELECT SUM(quantity) as total_quantity, user_id FROM tbl_transactions WHERE transaction_id = ?");
            $quantityQuery->bind_param('i', $transactionId);
            $quantityQuery->execute();
            $quantityResult = $quantityQuery->get_result();
            $row = $quantityResult->fetch_assoc();
            $totalQuantity = $row['total_quantity'];
            $userId = $row['user_id']; 

            if ($totalQuantity > 0) {
                $updatePointsQuery = $conn->prepare("UPDATE tbl_users SET points = points + ? WHERE id = ?");
                $updatePointsQuery->bind_param('ii', $totalQuantity, $userId);
                $updatePointsQuery->execute();
                $updatePointsQuery->close();
            }
            $quantityQuery->close();
        }

        echo json_encode(['success' => true, 'message' => 'Order status updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update order status.']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Transaction ID and action are required.']);
}

$conn->close();