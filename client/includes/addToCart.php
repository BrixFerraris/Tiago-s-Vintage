<?php
include_once './dbCon.php';
session_start();
$user_id = $_SESSION["uID"];
$current_datetime = date('YmdHis');
$base_transaction_id = $current_datetime;



$quantity = $_POST['quantity'];
$product_id = $_POST['id'];
$sql2 = "SELECT * FROM tbl_products WHERE id = $product_id";

$result2 = mysqli_query($conn, $sql2);

$row2 = mysqli_fetch_assoc($result2);

$total = $quantity * $row2['price'];

$sql = 'INSERT INTO tbl_transactions( product_id, quantity, user_id, date, total) VALUES(?, ?, ?, NOW(), ?)';

$stmt = $conn->prepare($sql);

$stmt->bind_param('sisi',  $product_id, $quantity, $user_id, $total);

$stmt->execute();

$stmt->close();

echo "<script> 
        alert('Added to cart Successfully');
        window.location.href = '../productList.php';
      </script>";