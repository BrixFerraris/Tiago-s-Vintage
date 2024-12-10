<?php
include_once './dbCon.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $price = $_POST['unit_price'];
    $retail_price = $_POST['retail_price'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $lowstock = isset($_POST['lowstock']) ? intval($_POST['lowstock']) : null;

    $img1 = $img2 = $img3 = null;
    $video = null;

    $targetDir = "uploads/";

    $imageCount = isset($_FILES['photoInput']['name']) ? count($_FILES['photoInput']['name']) : 0;
    if ($imageCount > 3) {
        header("location: ../addProduct.php?error=toomanyimages");
        exit();
    }

    for ($i = 0; $i < $imageCount; $i++) {
        if ($_FILES['photoInput']['error'][$i] === UPLOAD_ERR_OK) {
            $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['photoInput']['type'][$i], $allowedImageTypes)) {
                header("location: ../addProduct.php?error=invalidimagetype");
                exit();
            }

            $imageExtension = pathinfo($_FILES['photoInput']['name'][$i], PATHINFO_EXTENSION);
            $imgName = time() . '_' . uniqid('', true) . '.' . $imageExtension;
            $targetFilePath = $targetDir . $imgName;

            if (move_uploaded_file($_FILES['photoInput']['tmp_name'][$i], $targetFilePath)) {
                switch ($i) {
                    case 0:
                        $img1 = $imgName;
                        break;
                    case 1:
                        $img2 = $imgName;
                        break;
                    case 2:
                        $img3 = $imgName;
                        break;
                }
            } else {
                header("location: ../addProduct.php?error=imageuploadfailed");
                exit();
            }
        }
    }

    if (isset($_FILES['videoInput']) && $_FILES['videoInput']['error'] === UPLOAD_ERR_OK) {
        $allowedVideoTypes = ['video/mp4', 'video/avi', 'video/mpeg', 'video/x-matroska'];
        if (!in_array($_FILES['videoInput']['type'], $allowedVideoTypes)) {
            header("location: ../addProduct.php?error=invalidvideotype");
            exit();
        }

        $videoExtension = pathinfo($_FILES['videoInput']['name'], PATHINFO_EXTENSION);
        $videoName = time() . '_' . uniqid('', true) . '.' . $videoExtension;
        $videoTargetPath = $targetDir . $videoName;

        if (move_uploaded_file($_FILES['videoInput']['tmp_name'], $videoTargetPath)) {
            $video = $videoName;
        } else {
            header("location: ../addProduct.php?error=videouploadfailed");
            exit();
        }
    }

    $sql = "INSERT INTO tbl_products (title, unit_price, retail_price, category, img1, img2, img3, videoInput, description, stock_alert) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../addProduct.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sddssssssi", $title, $price, $retail_price, $category, $img1, $img2, $img3, $video, $description, $lowstock);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("location: ../addProduct.php?error=none");
        exit();
    } else {
        mysqli_stmt_close($stmt);
        header("location: ../addProduct.php?error=sqlerror");
        exit();
    }
} else {
    header("location: ../addProduct.php");
    exit();
}
