<?php
include_once './dbCon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM tbl_variations WHERE quantity = 0";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Rows with quantity 0 deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting rows: ' . mysqli_error($conn)]);
    }

    mysqli_close($conn);
}