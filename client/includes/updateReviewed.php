<?php
include_once './dbCon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_id = isset($_POST['transaction_id']) ? $_POST['transaction_id'] : null;

    if ($transaction_id !== null && !empty($transaction_id)) {
        $stmt = $mysqli->prepare("UPDATE tbl_transactions SET reviewed = 'true' WHERE transaction_id = ?");
        
        $stmt->bind_param("s", $transaction_id);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Transaction reviewed successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update transaction.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid transaction ID.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

$mysqli->close();