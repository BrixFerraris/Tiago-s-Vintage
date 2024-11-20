<?php
require_once 'dbCon.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $productId = $data['id'] ?? null;

    if ($productId) {
        $stmt = $conn->prepare("SELECT * FROM tbl_products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            echo json_encode([
                'type' => 'edit-product',
                'title' => $row['title'],
                'price' => $row['price'],
                'description' => $row['description'],
                'img1' => $row['img1'],
                'img2' => $row['img2'],
                'img3' => $row['img3'],
                'img4' => $row['img4']
            ]);
        } else {
            echo json_encode(['error' => 'Product not found']);
        }
    } else {
        echo json_encode(['error' => 'Invalid product ID']);
    }
}