<?php
include_once './dbCon.php';

$fb = $_POST['fb'];
$ig = $_POST['ig'];
$number = $_POST['number'];
$email = $_POST['email'];
$location = $_POST['location'];

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $targetDir = "uploads/"; 
    $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $bgFileName = uniqid('', true) . '-' . time() . '.' . $fileExtension;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $bgFileName)) {
        echo "<script>
        alert('Image upload failed');
        window.location.href='../pageManagement.php?error=fileUploadFailed';
        </script>";
        exit();
    }
}

$sql = "UPDATE tbl_settings SET fb = ?, ig = ?, number = ?, email = ?, address = ?" . (isset($bgFileName) ? ", image = ?" : "") . " WHERE cms_id = 1";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../pageManagement.php?stmtFailed");
    exit();
}

if (isset($bgFileName)) {
    mysqli_stmt_bind_param($stmt, "sssss", $fb, $ig, $number, $email, $location);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_param($stmt, "s", $bgFileName);
} else {
    mysqli_stmt_bind_param($stmt, "sssss", $fb, $ig, $number, $email, $location);
}

if (mysqli_stmt_execute($stmt)) {
    echo "<script>
    alert('Contact settings updated successfully');
    window.location.href='../pageManagement.php?error=none';
    </script>";
} else {
    echo "<script>
    alert('Error updating contact settings');
    window.location.href='../pageManagement.php?error=stmtFailed';
    </script>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
exit();