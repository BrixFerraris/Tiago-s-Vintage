<?php
include_once './dbCon.php';

$footer = $_POST['footerr'];

$sql = "UPDATE tbl_settings SET footer = ? WHERE cms_id = 1"; 
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../pageManagement.php?stmtFailed");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $footer);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

echo "<script>
alert('Footer section updated successfully');
window.location.href='../pageManagement.php?error=none';
</script>";
exit();