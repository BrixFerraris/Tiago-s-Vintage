<?php
include './header.php';
?>

<!-- Main Content -->
<div class="container">
    <!-- Order Tabs -->
    <div class="tabs">
        <button class="tab-button active" onclick="window.location.href='toPay.php'">To Pay</button>
        <button class="tab-button" onclick="window.location.href='toShip.php'">To Ship</button>
        <button class="tab-button" onclick="window.location.href='toReceived.php'">To Receive</button>
        <button class="tab-button" onclick="window.location.href='completed.php'">Completed</button>
        <button class="tab-button" onclick="window.location.href='cancelled.php'">Cancelled</button>
    </div>

    <!-- To Pay Orders Section -->
    <div class="order-section" id="to-pay">
        <h4>My Orders - To Pay</h4>

        <div class="order-item">
            <div class="item-details">
                <img src="shirt.png" alt="Product Image">
                <div>
                    <h5>Davey Allison 28 Big Print</h5>
                    <p>Size: 25W X 35L (Large)</p>
                    <p>Quantity: 1</p>
                </div>
            </div>
            <div class="item-status">
                <p class="status pending">Pending</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
            <div class="item-action">
                <button class="pay-button">Pay Now</button>
                <button class="cancel-button">Cancel</button>
            </div>
        </div>

        <!-- Add more orders to pay here as needed -->

        <div class="order-item">
            <div class="item-details">
                <img src="shirt.png" alt="Product Image">
                <div>
                    <h5>Davey Allison 28 Big Print</h5>
                    <p>Size: 25W X 35L (Large)</p>
                    <p>Quantity: 1</p>
                </div>
            </div>
            <div class="item-status">
                <p class="status pending">Pending</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
            <div class="item-action">
                <button class="pay-button">Pay Now</button>
                <button class="cancel-button">Cancel</button>
            </div>
        </div>

    </div>
</div>
<div class="modal-payment">
    <div class="modals">

        <h2>Payment Method</h2>
        <h6>Scan to pay</h6>
        <img src="../assets/QR.png" alt="" width="30%" height="45%">
        <h4>Amount: 1500 </h4>
        <p>We accept Gcash only. After scanning the QR code, please put the receipt on the box given.</p>
        <input type="file" id="myFile" name="filename">
       
        <div class="order-btn">
            <button class="btnSubmit">Submit</button>
            <button class="btnBack">Back</button>
            <div class="order-btn">
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
    background-color: #4CAF50;
    color: white;
}

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

.item-action {
    display: flex;
    gap: 10px;
}

/* Pending status */
.status.pending {
    color: orange;
    font-weight: bold;
}

/* Pay Now and Cancel Buttons */
.pay-button, .cancel-button {
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

.pay-button {
    background-color: #4CAF50;
    color: white;
}

.cancel-button {
    background-color: #f44336;
    color: white;
}

.pay-button:hover, .cancel-button:hover {
    opacity: 0.9;
}
.order-selection h3{
    font-weight: bold;
}
.item-details p{
    font-size: small;
}
.btnCheckout, .btnCancel, .btnBack, .btnSubmit{
    padding: 10px 20px;
    background-color: green;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer; /* Add this line */
}

.btnCancel {
    background-color: #ccc;
}
.modal-payment {
    position: fixed;
    width: 100%;
    height: 100vh;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    visibility: hidden;
    opacity: 0;
    transition: visibility 0s, opacity 0.3s ease-in-out;
}

.modal-active {
    visibility: visible;
    opacity: 1;
}

.modals{
    background-color: white;
    width: 50%;
    height: 70%;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: column;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.order-btn{
    margin-top: 5%;
    justify-content: space-around;
    
}
</style>
<script>
        var modalBtn = document.querySelector('.pay-button');
    var modalBg = document.querySelector('.modal-payment');
    var modalClose = document.querySelector('.btnBack');
    
    modalBtn.addEventListener('click', function() {
        modalBg.classList.add('modal-active');
    });
    modalClose.addEventListener('click', function(){
        modalBg.classList.remove('modal-active');
    });
</script>

<?php
include_once 'footer.php';
?>