<?php
require_once 'dbCon.php';

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    $stmt = $conn->prepare("SELECT * FROM tbl_products WHERE title LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
} else {
    echo json_encode(['error' => 'No search query provided']);
}