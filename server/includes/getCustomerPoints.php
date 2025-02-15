<?php
include_once './dbCon.php';
header('Content-Type: application/json');

$sql = "SELECT u.id, u.username, u.points, COUNT(t.transaction_id) AS orders_completed
        FROM tbl_transactions t 
        INNER JOIN tbl_users u ON t.user_id = u.id 
        WHERE t.status = 'Completed'
        GROUP BY u.id";

$result = $conn->query($sql);

$data = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(['error' => $conn->error]);
}

$conn->close();
