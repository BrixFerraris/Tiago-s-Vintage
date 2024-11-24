<?php
include_once './dbCon.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    
    $img1 = $img2 = $img3 = $img4 = null;
    
    $targetDir = "uploads/";
    $imageCount = isset($_FILES['photoInput']['name']) ? count($_FILES['photoInput']['name']) : 0;
    
    if ($imageCount > 4) {
        header("location: ../addProduct.php?error=toomanyimages");
        exit();
    }
    
    for ($i = 0; $i < $imageCount; $i++) {
        if ($_FILES['photoInput']['error'][$i] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['photoInput']['type'][$i], $allowedTypes)) {
                header("location: ../addProduct.php?error=invalidfiletype");
                exit();
            }
            
            $fileExtension = pathinfo($_FILES['photoInput']['name'][$i], PATHINFO_EXTENSION);
            $imgName = uniqid('', true) . '.' . $fileExtension;
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
                    case 3:
                        $img4 = $imgName;
                        break;
                }
            } else {
                header("location: ../addProduct.php?error=uploadfailed");
                exit();
            }
        }
    }
    
    $sql = "INSERT INTO tbl_products (title, price, category, img1, img2, img3, img4, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../addProduct.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "sissssss", $title, $price, $category, $img1, $img2, $img3, $img4, $description);
    
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