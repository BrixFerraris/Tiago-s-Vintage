<?php
include_once './dbCon.php';

$sql = "SELECT u.id, u.username, COUNT(t.id) AS orders_completed, u.points, u.points_updated 
        FROM tbl_transactions t 
        INNER JOIN tbl_users u ON t.user_id = u.id 
        WHERE t.status = 'Completed' 
        GROUP BY u.id";

$result = $conn->query($sql);
$data = array();
$currentDateTime = date('Y-m-d H:i:s');

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        $newPoints = $row['orders_completed'] * 1;
        if (is_null($row['points_updated'])) {
            $updateSql = "UPDATE tbl_users SET points = points + $newPoints, points_updated = '$currentDateTime' WHERE id = " . $row['id'];
            $conn->query($updateSql);
        }
    }
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($data);
