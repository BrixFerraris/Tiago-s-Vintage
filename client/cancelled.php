<?php
include './header.php';
?>
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
        <h4>My Orders - Cancelled</h4>

        <div class="order-item">
            <div class="item-details">
                <img src="shirt.png" alt="Product Image">
                <div>
                    <h5>Davey Allison 28 Big Print</h5>
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
                    <h5>Davey Allison 28 Big Print</h5>
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
<style>
    
body {

    background-color: #f0f0f5;
}
.container p{
    color: black;
}
.container p:hover{
    cursor: default;
}
.container {
    width: 80%;
    margin: 20px auto;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.menu {
    list-style: none;
    display: flex;
    justify-content: center;
}

.menu li {
    margin: 0 20px;
}

.menu a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
}

.menu a:hover {
    text-decoration: underline;
}

/* Tabs for Orders */
.tabs {
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
}

.tab-button {
    background-color: #f0f0f5;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

.tab-button.active {
    background-color: #f44336;
    color: white;
}

/* Order Section */
.order-section {
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

.order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ddd;
    padding: 15px 0;
}

.item-details {
    display: flex;
    align-items: center;
}

.item-details img {
    width: 80px;
    height: 80px;
    margin-right: 15px;
}

.item-status {
    width: 100px;
    text-align: center;
}

.item-price {
    width: 100px;
    text-align: center;
}

/* Cancelled status */
.status.cancelled {
    color: red;
    font-weight: bold;
}


    .item-details p{
    font-size: small;
}
</style>
<?php
include_once 'footer.php';
?>
