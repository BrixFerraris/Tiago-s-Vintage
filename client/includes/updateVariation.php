<?php
include_once './dbCon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $variations = isset($_POST['variations']) ? $_POST['variations'] : [];

    if (!empty($variations)) {
        foreach ($variations as $variation) {
            $variation_id = intval($variation['id']); 
            $quantity = intval($variation['quantity']); 

            $sql = "UPDATE tbl_variations SET quantity = quantity + $quantity WHERE id = $variation_id"; 

            if (!mysqli_query($conn, $sql)) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update quantity for variation ID ' . $variation_id]);
                exit; 
            }
        }
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No variations provided']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}