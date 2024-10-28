<?php
include_once './dbCon.php';

$landingText = isset($_POST['landing_text']) ? $_POST['landing_text'] : null;
$bgFileName = null;

$targetDir = "uploads/";

if (isset($_FILES['landing_bg']) && $_FILES['landing_bg']['error'] === UPLOAD_ERR_OK) {
    $fileExtension = pathinfo($_FILES['landing_bg']['name'], PATHINFO_EXTENSION);
    $bgFileName = uniqid('', true) . '-' . time() . '.' . $fileExtension;

    if (!move_uploaded_file($_FILES['landing_bg']['tmp_name'], $targetDir . $bgFileName)) {
        echo "<script>
        alert('Background upload failed');
        window.location.href='../pageManagement.php?error=fileUploadFailed';
        </script>";
        exit();
    }
}

$sql = "UPDATE tbl_settings SET";
$params = [];
$types = "";

if ($landingText !== null && $landingText !== "") {
    $sql .= " landing_text = ?";
    $params[] = $landingText;
    $types .= "s"; 
}

if ($bgFileName !== null) {
    if (!empty($params)) {
        $sql .= ",";
    }
    $sql .= " landing_bg = ?";
    $params[] = $bgFileName;
    $types .= "s"; 
}

$sql .= " WHERE cms_id = 1";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../pageManagement.php?stmtFailed");
    exit();
}

if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

echo "<script>
alert('Landing settings updated successfully');
window.location.href='../pageManagement.php?error=none';
</script>";
exit();