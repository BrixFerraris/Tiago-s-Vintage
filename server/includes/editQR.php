<?php
include_once './dbCon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['qrCode']) && $_FILES['qrCode']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $fileExtension = pathinfo($_FILES['qrCode']['name'], PATHINFO_EXTENSION);
        $qrCodeFilename = uniqid('', true) . '.' . $fileExtension;

        if (move_uploaded_file($_FILES['qrCode']['tmp_name'], $targetDir . $qrCodeFilename)) {
            $sql = "UPDATE tbl_settings SET qr = ? WHERE cms_id = 1";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "<script>
                alert('Error updating contact settings');
                window.location.href='../pageManagement.php?error=stmtFailed';
                </script>";
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $qrCodeFilename);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            echo "<script>
            alert('Successfully updated QR Code');
            window.location.href='../pageManagement.php?error=none';
            </script>";
            exit();
        } else {
            echo "<script>
        alert('Error uploading file');
            window.location.href='../pageManagement.php?error=stmtFailed';
            </script>";
            exit();
        }
    } else {
        echo "<script>
        alert('Error uploading file');
        window.location.href='../pageManagement.php?error=fileNotUploaded';
        </script>";
                exit();
    }
} else {
    echo "<script>
    alert('Error updating contact settings');
    window.location.href='../pageManagement.php?error=stmtFailed';
    </script>";
    exit();
}