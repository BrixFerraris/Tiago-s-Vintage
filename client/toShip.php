<?php
include './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status - To Ship</title>
    <link rel="stylesheet" href="../CSS/toShip.css">
</head>
<body>

<div class="order-status-container">
    <div class="order-tabs">
        <button>To Pay</button>
        <button class="active-tab">To Ship</button>
        <button>To Received</button>
        <button>Completed</button>
        <button>Cancelled</button>
    </div>

    <div class="order-items">
        <div class="order-item">
            <img src="davey-allison-shirt.jpg" alt="Davey Allison 28 Big Print">
            <div class="item-details">
                <h3>Davey Allison 28 Big Print</h3>
                <p>25W X 35L (Large)</p>
                <p>x1</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
        </div>

        <div class="order-item">
            <img src="davey-allison-shirt.jpg" alt="Davey Allison 28 Big Print">
            <div class="item-details">
                <h3>Davey Allison 28 Big Print</h3>
                <p>25W X 35L (Large)</p>
                <p>x1</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
        </div>

        <div class="order-item">
            <img src="davey-allison-shirt.jpg" alt="Davey Allison 28 Big Print">
            <div class="item-details">
                <h3>Davey Allison 28 Big Print</h3>
                <p>25W X 35L (Large)</p>
                <p>x1</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
        </div>
    </div>

    <div class="order-summary">
        <p>Status: <span class="shipping-status">Shipping</span></p>
        <p>Order Total: <span class="order-total">₱4500</span></p>
        <div class="action-buttons">
            <button class="cancel-button">Cancel</button>
        </div>
    </div>
</div>

</body>
</html>
