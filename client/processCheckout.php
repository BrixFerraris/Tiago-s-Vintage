<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $contact = htmlspecialchars($_POST['contact']);
    $payment_method = htmlspecialchars($_POST['payment_method']);
    $shipping_method = htmlspecialchars($_POST['shipping_method']);

    // Process payment and save the order
    // Example: Use a database query or API to handle the order submission

    echo "Thank you, $name! Your order has been placed.";
}
?>
