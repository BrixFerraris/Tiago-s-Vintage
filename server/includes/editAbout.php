<?php
include_once './dbCon.php';

$aboutText = $_POST['about'];

$targetDir = "uploads/";

$img1 = $img2 = $img3 = $img4 = "";  

function handleFileUpload($fileInputName) {
    global $targetDir;
    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == 0) {
        $fileExtension = pathinfo($_FILES[$fileInputName]['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid('', true) . '.' . $fileExtension;
        move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetDir . $newFileName);
        return $newFileName;
    }
    return null;  
}

if ($_FILES['about_img']['error'] == 0) $img1 = handleFileUpload('about_img');
if ($_FILES['about_img2']['error'] == 0) $img2 = handleFileUpload('about_img2');
if ($_FILES['about_img3']['error'] == 0) $img3 = handleFileUpload('about_img3');
if ($_FILES['about_img4']['error'] == 0) $img4 = handleFileUpload('about_img4');

$sql = "UPDATE tbl_settings SET about = ?, about_img = ?, about_img2 = ?, about_img3 = ?, about_img4 = ? WHERE cms_id = 1";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../pageManagement.php?stmtFailed");
    exit();
}

mysqli_stmt_bind_param($stmt, "sssss", $aboutText, $img1, $img2, $img3, $img4);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("location: ../pageManagement.php?error=none");
exit();