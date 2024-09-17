<?php
include './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - To Receive</title>
    <link rel="stylesheet" href="../CSS/toReceived.css">
</head>
<body>

<div class="order-status-container">
    <div class="order-tabs">
        <button class="tab-btn active-tab" onclick="showTab('to-pay')">To Pay</button>
        <button class="tab-btn" onclick="showTab('to-ship')">To Ship</button>
        <button class="tab-btn" onclick="showTab('to-receive')">To Receive</button>
        <button class="tab-btn" onclick="showTab('completed')">Completed</button>
        <button class="tab-btn" onclick="showTab('cancelled')">Cancelled</button>
    </div>

    <!-- To Receive Section -->
    <div class="order-section" id="to-receive">
        <h2>My Orders - To Receive</h2>

        <div class="order-item">
            <div class="item-details">
                <img src="shirt.png" alt="Product Image">
                <div>
                    <h3>Davey Allison 28 Big Print</h3>
                    <p>Size: 25W X 35L (Large)</p>
                    <p>Quantity: 1</p>
                    <p>Total Items: 1</p>
                </div>
            </div>
            <div class="item-status">
                <p class="status to-receive">To Receive</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
            <div class="item-actions">
                <button class="confirm-receive-btn">Order Received</button>
            </div>
        </div>

        <!-- Add more order items here as needed -->
         
        <div class="order-item">
            <div class="item-details">
                <img src="shirt.png" alt="Product Image">
                <div>
                    <h3>Davey Allison 28 Big Print</h3>
                    <p>Size: 25W X 35L (Large)</p>
                    <p>Quantity: 1</p>
                    <p>Total Items: 1</p>
                </div>
            </div>
            <div class="item-status">
                <p class="status to-receive">To Receive</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
            <div class="item-actions">
                <button class="confirm-receive-btn">Order Received</button>
            </div>
        </div>

         <!-- Add more order items here as needed -->
         
         <div class="order-item">
            <div class="item-details">
                <img src="shirt.png" alt="Product Image">
                <div>
                    <h3>Davey Allison 28 Big Print</h3>
                    <p>Size: 25W X 35L (Large)</p>
                    <p>Quantity: 1</p>
                    <p>Total Items: 1</p>
                </div>
            </div>
            <div class="item-status">
                <p class="status to-receive">To Receive</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
            <div class="item-actions">
                <button class="confirm-receive-btn">Order Received</button>
            </div>
        </div>

    </div>
</div>

<?php
include_once 'footer.php';
?>