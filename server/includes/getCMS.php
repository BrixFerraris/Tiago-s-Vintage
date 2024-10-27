<?php
include_once './dbCon.php';

$sql = "SELECT * FROM tbl_settings WHERE cms_id = 1"; 
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row); 
} else {
    echo json_encode(['error' => 'Failed to fetch settings']);
}