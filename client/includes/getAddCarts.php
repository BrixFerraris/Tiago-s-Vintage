<?php
session_start();
require_once 'dbCon.php';

    $userID = $_SESSION['uID'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS total_transactions FROM tbl_transactions WHERE status = 'Cart' AND user_id = ?");
    $stmt->bind_param("s", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);