<?php
include_once './dbCon.php';
if (isset($_POST['transaction_id'])) {
    $transactionId = $_POST['transaction_id'];
    $stmt = $conn->prepare("UPDATE tbl_transactions SET status = ? WHERE transaction_id = ?");
    $status = 'Ready For Pickup';
    $stmt->bind_param('si', $status, $transactionId); 
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Order status updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update order status.']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Transaction ID is required.']);
}
$conn->close();