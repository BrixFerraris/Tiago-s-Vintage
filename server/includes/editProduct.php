<?php
include_once './dbCon.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

$targetDir = "uploads/";

function handleFileUpload($fileKey, $targetDir) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
        $fileExtension = pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid('', true) . '.' . $fileExtension;
        if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetDir . $newFileName)) {
            return $newFileName;
        } else {
            echo "Failed to move file: " . $_FILES[$fileKey]['name'];
        }
    } else {
        echo "Error uploading file: " . $_FILES[$fileKey]['name'] . " with error code: " . $_FILES[$fileKey]['error'];
    }
    return null;
}

$id = $_POST['id'];
$img1 = handleFileUpload('img1', $targetDir);
$img2 = handleFileUpload('img2', $targetDir);
$img3 = handleFileUpload('img3', $targetDir);
$img4 = handleFileUpload('img4', $targetDir);

$sql = "UPDATE tbl_products SET img1 = ?, img2 = ?, img3 = ?, img4 = ? WHERE id = ?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo json_encode(["status" => "error", "message" => "Statement preparation failed"]);
    exit();
}

mysqli_stmt_bind_param($stmt, "sssss", $img1, $img2, $img3, $img4, $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

echo json_encode(["status" => "success", "message" => "Product images updated successfully"]);
header("Location: ../product.php");