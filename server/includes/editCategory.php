<?php
include_once './dbCon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $categoryName = $_POST['categoryName'];

    if (empty($id) || empty($categoryName)) {
        echo json_encode(['status' => 'error', 'message' => 'EmptyInput']);
        echo '
        <script>
            alert("Empty Input");
            window.location.href="../category.php?error=EmptyInput";
        </script>
    ';  
        exit();
    }

    $imagePath = null;

    if (isset($_FILES['filename']) && $_FILES['filename']['error'] == 0) {
        $targetDir = "uploads/";
        $fileExtension = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
        $imagePath = uniqid('', true) . '.' . $fileExtension;

        if (!move_uploaded_file($_FILES['filename']['tmp_name'], $targetDir . $imagePath)) {
            echo json_encode(['status' => 'error', 'message' => 'Image upload failed']);
            echo '
            <script>
                alert("Image upload failed");
                window.location.href="../category.php?error=UploadFailed";
            </script>
        ';  
            exit();
        }
    }

    if ($imagePath) {
        $sql = "UPDATE tbl_categories SET category = ?, image = ? WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo json_encode(['status' => 'error', 'message' => 'stmtFailed']);
            echo '
            <script>
                alert("stmtFailed");
                window.location.href="../category.php?error=stmtFailed";
            </script>
        ';  
        exit();
        }

        mysqli_stmt_bind_param($stmt, "ssi", $categoryName, $imagePath, $id);
    } else {
        $sql = "UPDATE tbl_categories SET category = ? WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo json_encode(['status' => 'error', 'message' => 'stmtFailed']);
            echo '
            <script>
                alert("stmtFailed");
                window.location.href="../category.php?error=stmtFailed";
            </script>
        ';    
            exit();
        }

        mysqli_stmt_bind_param($stmt, "si", $categoryName, $id);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo json_encode(['status' => 'success', 'message' => 'Category updated successfully']);
    echo '
        <script>
            alert("Category updated successfully");
            window.location.href="../category.php?error=none";
        </script>
    ';
    exit();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid access']);
    echo '
        <script>
            alert("Invalid access");
            window.location.href="../category.php?error=InvalidAccess";
        </script>
    ';    
    exit();
}
