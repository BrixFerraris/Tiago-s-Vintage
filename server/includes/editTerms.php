<?php
include_once './dbCon.php';

$terms = $_POST['terms'];

$sql = "UPDATE tbl_settings SET terms = ? WHERE cms_id = 1"; // Assuming you're updating the record with cms_id = 1
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../pageManagement.php?stmtFailed");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $terms);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

echo "<script>
alert('Terms and Conditions updated successfully');
window.location.href='../pageManagement.php?error=none';
</script>";
exit();