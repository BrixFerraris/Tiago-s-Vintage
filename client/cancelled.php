<?php
include './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Cancelled</title>
    <link rel="stylesheet" href="../CSS/cancelled.css">
</head>
<body>

<!-- Main Content -->
<div class="container">
    <!-- Order Tabs -->
    <div class="tabs">
        <button class="tab-button" onclick="window.location.href='toPay.php'">To Pay</button>
        <button class="tab-button" onclick="window.location.href='toShip.php'">To Ship</button>
        <button class="tab-button" onclick="window.location.href='toReceived.php'">To Receive</button>
        <button class="tab-button" onclick="window.location.href='completed.php'">Completed</button>
        <button class="tab-button active" onclick="window.location.href='cancelled.php'">Cancelled</button>
    </div>



    <!-- Cancelled Orders Section -->
    <div class="order-section" id="cancelled">
        <h2>My Orders - Cancelled</h2>

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
                <p class="status cancelled">Cancelled</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
        </div>

        <!-- Add more cancelled order items here as needed -->

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
                <p class="status cancelled">Cancelled</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
        </div>


      <!-- Add more cancelled order items here as needed -->

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
                <p class="status cancelled">Cancelled</p>
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
