<?php
include_once './dbCon.php';

$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['id'])) {
    $productID = $data['id'];
    $sql = "SELECT * FROM tbl_products WHERE id = ?"; 
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("s", $productID); 
    
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            'type' => 'edit-product',
            'title' => $row['title'],
            'price' => $row['price'],
            'category' => $row['category']
        ]);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
    $stmt->close();
} else {
    echo json_encode(['error' => 'Product ID is missing']);
}
$conn->close();