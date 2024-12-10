<?php
include_once './dbCon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $variationName = $_POST['Name'];
    $width = isset($_POST['width']) ? (float)$_POST['width'] : null;
    $length = isset($_POST['length']) ? (float)$_POST['length'] : null;
    $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : 0;
    $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;

    $targetDir = "uploads/";

    if (empty($variationName) || empty($productId)) {
        echo "<script>
            alert('Name and Product ID are required.');
            window.location.href = '../adminEditProduct.php?product_id=$productId';
        </script>";
        exit();
    }

    if (isset($_FILES['imgVar']) && $_FILES['imgVar']['error'] === UPLOAD_ERR_OK) {
        $allowedVideoTypes = ['video/mp4', 'video/avi', 'video/mkv', 'video/x-matroska', 'video/mpeg'];
        $fileType = $_FILES['imgVar']['type'];

        if (!in_array($fileType, $allowedVideoTypes)) {
            echo "<script>
                alert('Invalid video type. Only MP4, AVI, MKV, and MPEG formats are allowed.');
                window.location.href = '../adminEditProduct.php?product_id=$productId';
            </script>";
            exit();
        }

        $fileExtension = pathinfo($_FILES['imgVar']['name'], PATHINFO_EXTENSION);
        $videoName = time() . "_" . uniqid('', true) . '.' . $fileExtension;
        $videoPath = $targetDir . $videoName;

        if (!move_uploaded_file($_FILES['imgVar']['tmp_name'], $videoPath)) {
            echo "<script>
                alert('Failed to upload video. Please try again.');
                window.location.href = '../adminEditProduct.php?product_id=$productId';
            </script>";
            exit();
        }
    } else {
        echo "<script>
            alert('Video upload is required.');
            window.location.href = '../adminEditProduct.php?product_id=$productId';
        </script>";
        exit();
    }

    $sql = 'INSERT INTO tbl_variations (product_id, variationName, width, length, quantity, vid_variation) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('isiiis', $productId, $variationName, $width, $length, $qty, $videoName);

        if ($stmt->execute()) {
            echo "<script>
                alert('Variation added successfully.');
                window.location.href = '../adminEditProduct.php?product_id=$productId';
            </script>";
        } else {
            echo "<script>
                alert('Failed to add variation. Please try again.');
                window.location.href = '../adminEditProduct.php?product_id=$productId';
            </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
            alert('Database error. Please try again.');
            window.location.href = '../adminEditProduct.php?product_id=$productId';
        </script>";
    }
} else {
    echo "<script>
        alert('Invalid request method.');
        window.location.href = '../adminEditProduct.php';
    </script>";
}
