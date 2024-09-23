<?php
include_once 'dbCon.php';

$newCategory = $_POST["category"];
$parentCategory = $_POST["parent"];

$sql = "INSERT INTO tbl_categories (parent, child) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param("ss",  $parentCategory, $newCategory);

if ($stmt->execute()) {
    echo "<script>
        alert('Successfully added new category');
        window.location.href = '../category.php';
    </script>";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();