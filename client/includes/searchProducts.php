<?php
require_once 'dbCon.php';

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    $stmt = $conn->prepare("
        SELECT 
            p.*, 
            CASE WHEN v.product_id IS NOT NULL THEN 1 ELSE 0 END as has_variations
        FROM tbl_products p
        LEFT JOIN tbl_variations v ON p.id = v.product_id
        WHERE p.title LIKE CONCAT('%', ?, '%') OR p.category = ?
        GROUP BY p.id
    ");
    $stmt->bind_param("ss", $query, $query);
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