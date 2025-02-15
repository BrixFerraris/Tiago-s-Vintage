<?php
include_once './dbCon.php';

if (isset($_POST['transaction_id']) && isset($_POST['action'])) {
    $transactionId = intval($_POST['transaction_id']); 
    $action = $_POST['action'];

    if ($action === 'accept') {
        $shipping = $_POST['shipping'];
        if ($shipping === 'pickup') {
            $status = 'Ready For Pickup';
        } elseif ($shipping === 'delivery') {
            $status = 'Out For Delivery';
        }
    } elseif ($action === 'complete') {
        $status = 'Completed'; 
    } elseif ($action === 'decline') {
        $status = 'Cancelled';
        $cancelReason = isset($_POST['cancel_reason']) ? trim($_POST['cancel_reason']) : '';

        $reasonStmt = $conn->prepare("UPDATE tbl_transactions SET status = ?, reason = ? WHERE transaction_id = ?");
        $reasonStmt->bind_param('ssi', $status, $cancelReason, $transactionId);
        $reasonUpdateSuccess = $reasonStmt->execute();
        $reasonStmt->close();

        if (!$reasonUpdateSuccess) {
            echo json_encode(['success' => false, 'message' => 'Failed to update order status with reason.']);
            exit;
        }

        $quantityStmt = $conn->prepare("
            UPDATE tbl_variations v
            INNER JOIN tbl_transactions t ON v.id = t.variation_id
            SET v.quantity = v.quantity + t.quantity
            WHERE t.transaction_id = ?");
        $quantityStmt->bind_param('i', $transactionId);
        $quantityStmt->execute();
        $quantityStmt->close();

        echo json_encode(['success' => true, 'message' => 'Order declined and stock quantity restored.']);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE tbl_transactions SET status = ? WHERE transaction_id = ?");
    $stmt->bind_param('si', $status, $transactionId); 

    if ($stmt->execute()) {
        if ($action === 'complete') {
            $quantityQuery = $conn->prepare("
                SELECT SUM(t.quantity) as total_quantity, t.user_id
                FROM tbl_transactions t
                WHERE t.transaction_id = ? AND t.status = 'Completed'");
            $quantityQuery->bind_param('i', $transactionId);
            $quantityQuery->execute();
            $quantityResult = $quantityQuery->get_result();
            $row = $quantityResult->fetch_assoc();

            $totalQuantity = $row['total_quantity'] ?? 0;
            $userId = $row['user_id'];

            if ($totalQuantity > 0 && $userId) {
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
