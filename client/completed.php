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
        <button class="tab-button active" onclick="window.location.href='completed.php'">Completed</button>
        <button class="tab-button" onclick="window.location.href='cancelled.php'">Cancelled</button>
    </div>

    <!-- Completed Orders Section -->
    <div class="order-section" id="completed">
        <h4>My Orders - Completed</h4>

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
                <p class="status completed">Completed</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
                </div>
            <div class="item-actions">
                <button class="confirm-receive-btn">Write Review</button>
                </div>
        </div>

        <!-- Add more completed order items here as needed -->
        <div class="order-item">
            <div class="item-details">
                <img src="shirt.png" alt="Product Image">
                <div>
                    <h5>Davey Allison 28 Big Print</h>
                    <p>Size: 25W X 35L (Large)</p>
                    <p>Quantity: 1</p>
                    <p>Total Items: 1</p>
                </div>
            </div>
            <div class="item-status">
                <p class="status completed">Completed</p>
            </div>
            <div class="item-price">
                <p>₱1500</p>
            </div>
            <div class="item-actions">
                <button class="confirm-receive-btn">Write Review</button>
            </div>
        </div>
        </div>

</div>
<div class="modal-review">
            <div class="modals">
                <h5>Write a review</h5>
                <div>
                <h6>Select your rating</h6>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                </div>
            <textarea name="comments" id="comments" rows="7" placeholder="Share more thoughts on the products to help other buy."></textarea>
            <div class="order-btn">
            <button class="btnSubmitReview">Submit</button>
            <button class="btnBack">Back</button>
            </div>
            </div>
    </div>
</body>
</html>
<style>
body {
    background-color: #f0f0f5;
}
textarea{
    padding-left: 10px;
}
.order-btn{
    display: flex; 
    align-items: center;
    margin-top: 1%;
    justify-content: space-around;
    
}
.modals 
.btnSubmitReview, .btnBack{
    padding: 10px 20px;
    background-color: green;
    width: 200px;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer; /* Add this line */
}

.modal-review{
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
    width: 40%;
    height: 70%;
    display: flex;
    justify-content: space-around;
    align-items: left;
    flex-direction: column;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);

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
    background-color: #4CAF50;
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

.item-actions {
    width: 150px;
    text-align: center;
}

/* Completed status */
.status.completed {
    color: green;
    font-weight: bold;
}

/* Button styles for "Confirm Receipt" */
.confirm-receive-btn {
    background-color: #0066cc;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.item-details p{
    font-size: small;
}
.confirm-receive-btn:hover {
    background-color: #004c99;
}
.checked {
  color: orange;
}
</style>

<script>
    var modalBtn = document.querySelector('.confirm-receive-btn');
    var modalBg = document.querySelector('.modal-review');
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
