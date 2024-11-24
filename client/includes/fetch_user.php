<?php
session_start();
include_once './dbCon.php';

if (isset($_POST['id'])) {
    $userId = $_POST['id'];

    $stmt = $conn->prepare("
        SELECT u.*, 
               COUNT(DISTINCT t.transaction_id) AS completed_transactions 
        FROM tbl_users u
        LEFT JOIN tbl_transactions t ON u.id = t.user_id AND t.status = 'Completed'
        WHERE u.id = ?

    ");
    
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user); 
    } else {
        echo json_encode(['error' => 'No user found.']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'User  not authenticated.']);
}
$conn->close();