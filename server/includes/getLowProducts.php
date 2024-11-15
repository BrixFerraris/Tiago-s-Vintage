<?php
header('Content-Type: application/json');
include_once './dbCon.php';

$query = "
    SELECT * FROM tbl_variations WHERE quantity < 5; 
";

$result = $conn->query($query);

$products = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products);

$conn->close();