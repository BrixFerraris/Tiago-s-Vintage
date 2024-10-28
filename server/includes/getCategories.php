<?php
include_once './dbCon.php';

$categories = [];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_categories WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo json_encode(['status' => 'error', 'message' => 'stmtFailed']);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $categories = mysqli_fetch_assoc($result);
    }

    mysqli_stmt_close($stmt);
} else {
    $sql = "SELECT * FROM tbl_categories";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
    }
}

header('Content-Type: application/json');
echo json_encode($categories);
