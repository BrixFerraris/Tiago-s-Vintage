<?php
include_once './dbCon.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];
    $transactionID = $_POST['transID'];
    $username = $_SESSION['username'];
    $title = $_POST['title'];
    $variationName = $_POST['variationName'];

    $img1 = $img2 = $img3 = null;

    $targetDir = "uploads/";
    $imageCount = isset($_FILES['photoInput']['name']) ? count($_FILES['photoInput']['name']) : 0;

    for ($i = 0; $i < $imageCount; $i++) {
        if ($_FILES['photoInput']['error'][$i] === UPLOAD_ERR_OK) {
            $fileExtension = pathinfo($_FILES['photoInput']['name'][$i], PATHINFO_EXTENSION);
            $imgName = uniqid('', true) . '.' . $fileExtension;
            $targetFilePath = $targetDir . $imgName;

            if (move_uploaded_file($_FILES['photoInput']['tmp_name'][$i], $targetFilePath)) {
                if ($i == 0) {
                    $img1 = $imgName;
                } elseif ($i == 1) {
                    $img2 = $imgName;
                } elseif ($i == 2) {
                    $img3 = $imgName;
                }
            }
        }
    }

    $sql = "INSERT INTO tbl_reviews (transactionID, review, rate, product_title, variation_name, username, img1, img2, img3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../completed.php?stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "isissssss", $transactionID, $comments, $rating, $title, $variationName, $username, $img1, $img2, $img3);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $updateSql = "UPDATE tbl_transactions SET reviewed = 'true' WHERE transaction_id = ?";
    $updateStmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($updateStmt, $updateSql)) {
        header("location: ../completed.php?stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($updateStmt, "s", $transactionID);
    mysqli_stmt_execute($updateStmt);
    mysqli_stmt_close($updateStmt);

    header("location: ../completed.php?error=none");
    exit();
} else {
    header("location: ../completed.php");
    exit();
}