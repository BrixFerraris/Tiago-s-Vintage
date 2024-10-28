<?php
include_once './dbCon.php';

$title = isset($_POST['title']) ? $_POST['title'] : null;
$logoFileName = null;

$targetDir = "uploads/";

if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
    $fileExtension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
    $logoFileName = uniqid('', true) . '-' . time() . '.' . $fileExtension;

    if (!move_uploaded_file($_FILES['logo']['tmp_name'], $targetDir . $logoFileName)) {
        echo "<script>
        alert('Logo upload failed');
        window.location.href='../pageManagement.php?error=fileUploadFailed';
        </script>";
        exit();
    }
}

$sql = "UPDATE tbl_settings SET";
$params = [];
$types = "";

if ($title !== null && $title !== "") {
    $sql .= " title = ?";
    $params[] = $title;
    $types .= "s"; 
}

if ($logoFileName !== null) {
    if (!empty($params)) {
        $sql .= ",";
    }
    $sql .= " logo = ?";
    $params[] = $logoFileName;
    $types .= "s"; 
}

$sql .= " WHERE cms_id = 1";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "<script>
    alert('Error Updating settings');
    window.location.href='../pageManagement.php?error=stmtFailed';
    </script>";
    exit();
}

if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

echo "<script>
alert('Settings updated successfully');
window.location.href='../pageManagement.php?error=none';
</script>";
exit();