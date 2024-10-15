<?php
include_once 'dbCon.php';

$parentCategory = $_POST["category"];

$sql = "SELECT COUNT(*) AS count FROM tbl_parent WHERE parent = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $parentCategory);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    echo "<script>
        alert('Main category already exists!');
        window.location.href = '../category.php';
    </script>";
} else {
    $sql = "INSERT INTO tbl_parent (parent) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $parentCategory);
    if ($stmt->execute()) {
        echo "<script>
            alert('Successfully added new category');
            window.location.href = '../category.php';
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();