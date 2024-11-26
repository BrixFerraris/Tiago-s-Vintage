<?php
require_once 'dbCon.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transactionId = $_POST['transactionId'] ?? null;
    $variationId = $_POST['variationId'] ?? null;
    $table = $_POST['table'] ?? '';

    if ($table === 'transactions' && $transactionId) {
        $stmt = $conn->prepare("UPDATE tbl_transactions SET seen = 'true' WHERE transaction_id = ?");
        $stmt->bind_param('i', $transactionId);
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'walang laman transID error';
        }
        $stmt->close();
    } elseif ($table === 'variations' && $variationId) {
        $stmt = $conn->prepare("UPDATE tbl_variations SET seen = 'true' WHERE id = ?");
        $stmt->bind_param('i', $variationId);
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'walang laman varID error';
        }
        $stmt->close();
    } else {
        echo 'hindi post method error';
    }
}