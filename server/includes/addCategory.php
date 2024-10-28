<?php
include_once './dbCon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['title']) || empty($_FILES['img1']['name'])) {
        header("location: ../carousel.php?error=EmptyInput");
        exit();
    }

    $targetDir = "uploads/";
    $fileExtension = pathinfo($_FILES['img1']['name'], PATHINFO_EXTENSION);
    $img1 = uniqid('', true) . '.' . $fileExtension;

    if (!move_uploaded_file($_FILES['img1']['tmp_name'], $targetDir . $img1)) {
        header("location: ../category.php?error=ImageUploadFailed");
        exit();
    }

    $sql = "INSERT INTO tbl_categories(category, image) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../category.php?stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $_POST['title'], $img1);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../category.php?error=none");
    exit();
} else {
    header("location: ../category.php?error=InvalidAccess");
    exit();
}