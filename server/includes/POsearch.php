<?php
require './dbCon.php';

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $conn->prepare("
            SELECT t.*, p.title AS product_name, u.firstName, u.lastName, u.username, u.points, u.contact 
            FROM tbl_transactions t 
            INNER JOIN tbl_products p ON t.product_id = p.id 
            INNER JOIN tbl_users u ON t.user_id = u.id 
            WHERE (u.firstName LIKE ? OR u.lastName LIKE ? OR u.username LIKE ?) AND t.status != 'Cart'
    ");

    $searchTerm = "%$query%";
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $transactions = [];
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }

    echo json_encode($transactions);
}