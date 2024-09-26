<?php
include_once './dbCon.php';

$title = $_POST['title'];
$price = $_POST['price'];
$category1 = $_POST['category'];
$description = $_POST['description'];
$sub_category = $_POST['sub_category'];

$targetDir = "uploads/";
$fileExtension = pathinfo($_FILES['img1']['name'], PATHINFO_EXTENSION);
$img1 = uniqid('', true) . '.' . $fileExtension;
$fileExtension = pathinfo($_FILES['img2']['name'], PATHINFO_EXTENSION);
$img2 = uniqid('', true). '.'. $fileExtension;
$fileExtension = pathinfo($_FILES['img3']['name'], PATHINFO_EXTENSION);
$img3 = uniqid('', true). '.'. $fileExtension;
$fileExtension = pathinfo($_FILES['img4']['name'], PATHINFO_EXTENSION);
$img4 = uniqid('', true). '.'. $fileExtension;

move_uploaded_file($_FILES['img1']['tmp_name'], $targetDir . $img1);
move_uploaded_file($_FILES['img2']['tmp_name'], $targetDir . $img2);
move_uploaded_file($_FILES['img3']['tmp_name'], $targetDir . $img3);
move_uploaded_file($_FILES['img4']['tmp_name'], $targetDir . $img4);
$sql = "INSERT INTO tbl_products (title, price, category, sub_category, img1, img2, img3, img4, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../addProduct.php?stmtFailed");
    exit();
}

mysqli_stmt_bind_param($stmt, "sisssssss", $title, $price, $category1, $sub_category, $img1, $img2, $img3, $img4, $description);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("location: ../addProduct.php?error=none");
exit();