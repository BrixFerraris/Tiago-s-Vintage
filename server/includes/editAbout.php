<?php
include_once './dbCon.php';

$aboutText = $_POST['about'];

$sql = "UPDATE tbl_settings SET about = ? WHERE cms_id = 1"; // Assuming you're updating the record with cms_id = 1
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../pageManagement.php?stmtFailed");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $aboutText);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

echo "<script>
alert('About section updated successfully');
window.location.href='../pageManagement.php?error=none';
</script>";
exit();