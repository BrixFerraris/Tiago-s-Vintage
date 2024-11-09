<?php
include_once './dbCon.php';
$sql = "SELECT u.id, u.username, COUNT(t.id) AS orders_completed, u.points 
        FROM tbl_transactions t 
        INNER JOIN tbl_users u ON t.user_id = u.id 
        WHERE t.status = 'Completed' 
        GROUP BY u.id";

$result = $conn->query($sql);
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        $newPoints = $row['orders_completed'] * 3;
        $updateSql = "UPDATE tbl_users SET points = points + $newPoints WHERE id = " . $row['id'];
        $conn->query($updateSql);
    }
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($data);