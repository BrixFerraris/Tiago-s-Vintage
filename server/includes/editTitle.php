<?php
include_once './dbCon.php';

$title = $_POST['title'];

$targetDir = "uploads/";
$fileExtension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
$logoFileName = uniqid('', true) . '-' . time() . '.' . $fileExtension; 

if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetDir . $logoFileName)) {
    $sql = "UPDATE tbl_settings SET title = ?, logo = ? WHERE cms_id = 1";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pageManagement.php?stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $title, $logoFileName); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo "<script>
    alert('Settings updated successfully');
    window.location.href='../pageManagement.php?error=none';
    </script>";
    exit();
} else {
    echo "<script>
    alert('Logo upload failed');
    window.location.href='../pageManagement.php?error=fileUploadFailed';
    </script>";
    exit();
}
