<?php
include_once 'dbCon.php';

header('Content-Type: application/json');

$query = "SELECT * FROM tbl_users WHERE role != 'Customer'";
$result = mysqli_query($conn, $query);

$admins = array();
while ($row = mysqli_fetch_assoc($result)) {
    $admins[] = $row;
}

echo json_encode($admins);