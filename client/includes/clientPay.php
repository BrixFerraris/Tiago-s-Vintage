<?php
session_start();
include_once './dbCon.php';

$targetDir = "uploads/";

$fileExtension = pathinfo($_FILES['img1']['name'], PATHINFO_EXTENSION);

$img1 = uniqid('', true) . '.' . $fileExtension;

if (!move_uploaded_file($_FILES['img1']['tmp_name'], $targetDir . $img1)) {
    header("location: ../toPay.php?uploadFailed");
    exit();
}
$sql = "INSERT INTO tbl_payments(receipt, u_id, amount, transaction_number) VALUES (?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../toPay.php?stmtFailed");
    exit();
}
$uID = $_SESSION['uID'];
$amount = $_POST['amount'];
$transID = $_POST['transID'];
mysqli_stmt_bind_param($stmt, "ssis", $img1, $uID, $amount, $transID);
if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("location: ../toPay.php?error=none");
} else {
    header("location: ../toPay.php?executionFailed");
}

mysqli_close($conn);
exit();