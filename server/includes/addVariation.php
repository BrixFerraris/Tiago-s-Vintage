<?php
include_once './dbCon.php';

$variationName = $_POST['Name'];
$width = $_POST['width'];
$length = $_POST['length'];
$qty = $_POST['qty'];
$productId = $_POST['product_id'];

$targetDir = "uploads/";

$fileExtension = pathinfo($_FILES['imgVar']['name'], PATHINFO_EXTENSION);

$img1 = uniqid('', true) . '.' . $fileExtension;

move_uploaded_file($_FILES['imgVar']['tmp_name'], $targetDir . $img1);



$sql = 'INSERT INTO tbl_variations(product_id, variationName, width, length, quantity, imgVar) VALUES(?,?,?,?,?,?)';

$stmt = $conn->prepare($sql);

$stmt->bind_param('isiiis', $productId, $variationName, $width, $length, $qty, $img1);

$stmt->execute();

echo "<script>
    window.location.href = '../adminEditProduct.php?product_id=$productId';
    alert('Variation added successfully');
</script>";