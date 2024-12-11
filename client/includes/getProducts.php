<?php
require_once './dbCon.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    if ($category === 'All') {
        $stmt = $conn->prepare("
            SELECT 
                p.*,
                CASE WHEN v.product_id IS NOT NULL THEN 1 ELSE 0 END as has_variations
            FROM tbl_products p
            LEFT JOIN tbl_variations v ON p.id = v.product_id
            WHERE v.product_id IS NOT NULL AND v.quantity > 0
            GROUP BY p.id
        ");
    } else {
        $stmt = $conn->prepare("
            SELECT 
                p.*,
                CASE WHEN v.product_id IS NOT NULL THEN 1 ELSE 0 END as has_variations
            FROM tbl_products p
            LEFT JOIN tbl_variations v ON p.id = v.product_id
            WHERE p.category = ? AND v.product_id IS NOT NULL AND v.quantity > 0
            GROUP BY p.id
        ");
        $stmt->bind_param("s", $category);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $row['has_variations'] = (bool)$row['has_variations'];
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode(['error' => 'No category specified']);
}