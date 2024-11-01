<?php
include_once './dbCon.php';

$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['idProduct'])) {
    $productID = $data['idProduct'];
    $sql = "SELECT * FROM tbl_variations WHERE product_id = ?"; 
    $stmt = $conn->prepare($sql);    
    $stmt->bind_param("i", $productID); 
    $stmt->execute();
    $result = $stmt->get_result();
    $variations = [];
    while ($row = $result->fetch_assoc()) {
        $variations[] = $row;
    }

    echo json_encode(['type' => 'variations', 'variations' => $variations]);
    $stmt->close();
} else {
    echo json_encode(['error' => 'Product ID is missing']);
}
$conn->close();