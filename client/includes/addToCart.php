<?php
include_once './dbCon.php';
session_start();
$user_id = $_SESSION["uID"];
$current_datetime = date('YmdHis');
$base_transaction_id = $current_datetime;

$variationID = $_POST['variationID'];
$quantity = $_POST['quantity'];
$product_id = $_POST['id'];

$sqlCheck = "SELECT quantity FROM tbl_transactions WHERE product_id = ? AND variation_id = ? AND user_id = ? AND status='Cart'";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param('ssi', $product_id, $variationID, $user_id);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    $row = $resultCheck->fetch_assoc();
    $newQuantity = $row['quantity'] + $quantity; 
    $sqlUpdate = "UPDATE tbl_transactions SET quantity = quantity + ? WHERE product_id = ? AND variation_id = ? AND user_id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param('isis', $quantity, $product_id, $variationID, $user_id);
    $stmtUpdate->execute();
    $stmtUpdate->close();
} else {
    $sql2 = "SELECT retail_price FROM tbl_products WHERE id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param('i', $product_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row2 = $result2->fetch_assoc();
    $total = $quantity * $row2['retail_price'];

    $sqlInsert = 'INSERT INTO tbl_transactions(product_id, quantity, user_id, date, total, variation_id) VALUES(?, ?, ?, NOW(), ?, ?)';
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param('sisis', $product_id, $quantity, $user_id, $total, $variationID);
    $stmtInsert->execute();
    $stmtInsert->close();
}

$stmtCheck->close();

echo "<script> 
        alert('Added to cart Successfully');
        window.location.href = '../shopcart.php';
      </script>";