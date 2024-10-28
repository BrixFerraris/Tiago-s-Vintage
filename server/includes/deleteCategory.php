<?php
include_once './dbCon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if (empty($id)) {
        echo json_encode(['status' => 'error', 'message' => 'EmptyInput']);
        exit();
    }

    $sql = "DELETE FROM tbl_categories WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo json_encode(['status' => 'error', 'message' => 'stmtFailed']);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo json_encode(['status' => 'success', 'message' => 'Category Deleted']);
    exit();
} else {
    echo json_encode(['status' => 'error', 'message' => 'InvalidAccess']);
    exit();
}
