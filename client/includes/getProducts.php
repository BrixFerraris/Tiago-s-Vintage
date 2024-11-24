<?php
require_once './dbCon.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    if ($category === 'All') {
        $stmt = $conn->prepare("SELECT * FROM tbl_products");
    } else {
        $stmt = $conn->prepare("SELECT * FROM tbl_products WHERE category = ?");
        $stmt->bind_param("s", $category);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode(['error' => 'No category specified']);
}