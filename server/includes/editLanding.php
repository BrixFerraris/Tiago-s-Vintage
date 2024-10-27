<?php
include_once './dbCon.php';

$landingText = $_POST['landing_text'];

$targetDir = "uploads/"; 
$fileExtension = pathinfo($_FILES['landing_bg']['name'], PATHINFO_EXTENSION);
$bgFileName = uniqid('', true) . '-' . time() . '.' . $fileExtension;

if (move_uploaded_file($_FILES['landing_bg']['tmp_name'], $targetDir . $bgFileName)) {
    $sql = "UPDATE tbl_settings SET landing_text = ?, landing_bg = ? WHERE cms_id = 1"; 
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pageManagement.php?stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $landingText, $bgFileName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo "<script>
    alert('Landing settings updated successfully');
    window.location.href='../pageManagement.php?error=none';
    </script>";
    exit();
} else {
    echo "<script>
    alert('Background upload failed');
    window.location.href='../pageManagement.php?error=fileUploadFailed';
    </script>";
    exit();
}
