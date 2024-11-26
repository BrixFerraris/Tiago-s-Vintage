<?php
include_once './dbCon.php';
session_start();
$user_id = $_SESSION["uID"] ?? 0;

$sqlGetNotifications = "
    SELECT *, COUNT(*) OVER() AS notification_count 
    FROM tbl_transactions 
    WHERE user_id = ? 
    AND (status = 'Ready For Pickup' OR status = 'Out For Delivery' OR status = 'Cancelled') 
    AND seen = 'false'";

$stmtGetNotifications = $conn->prepare($sqlGetNotifications);
$stmtGetNotifications->bind_param('i', $user_id);
$stmtGetNotifications->execute();

$resultGetNotifications = $stmtGetNotifications->get_result();
$notifications = $resultGetNotifications->fetch_all(MYSQLI_ASSOC);

$response = array(
    'notification_count' => count($notifications),
    'notifications' => $notifications
);

header('Content-Type: application/json');
echo json_encode($response);
$stmtGetNotifications->close();