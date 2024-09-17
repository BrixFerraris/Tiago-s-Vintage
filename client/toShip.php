<?php
include './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - To Ship</title>
    <link rel="stylesheet" href="../CSS/toShip.css">
</head>
<body>

<!-- Main Content -->
<div class="container">
    <!-- Order Tabs -->
    <div class="tabs">
        <button class="tab-button">To Pay</button>
        <button class="tab-button active">To Ship</button>
        <button class="tab-button">To Receive</button>
        <button class="tab-button">Completed</button>
        <button class="tab-button">Cancelled</button>
    </div>

    <!-- To Ship Section -->
    <div class="order-section" id="to-ship">
        <h2>My Orders - To Ship</h2>

        <div class="order-item">
            <div class="item-details">
                <img src="shirt.png" alt="Product Image">
                  <div>
                    <h3>Davey Allison 28 Big Print</h3>
                    <p>Size: 25W X 35L (Large)</p>
                    <p>Quantity: 1</p>
                    <p>Total Items: 4</p>
                </div>
            </div>
            <div class="item-status">
                <p class="status to-ship">To Ship</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
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
                    <p>Total Items: 4</p>
                </div>
            </div>
            <div class="item-status">
                <p class="status to-ship">To Ship</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
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
                    <p>Total Items: 4</p>
                </div>
            </div>
            <div class="item-status">
                <p class="status to-ship">To Ship</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
        </div>
    </div>

</div>
</body>
</html>

<?php
include_once 'footer.php';
?>