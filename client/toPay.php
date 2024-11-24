<?php
include './header.php';
?>

<!-- Main Content -->
<div class="container">
    <!-- Order Tabs -->
    <div class="tabs">
        <button class="tab-button active" onclick="window.location.href='toPay.php'">To Pay</button>
        <button class="tab-button" onclick="window.location.href='toReceived.php'">To Receive</button>
        <button class="tab-button" onclick="window.location.href='completed.php'">Completed</button>
        <button class="tab-button" onclick="window.location.href='cancelled.php'">Cancelled</button>
    </div>

    <!-- To Pay Orders Section -->
    <div class="order-section" id="to-pay">
        <h4>My Orders - To Pay</h4>
    </div>
</div>
<div class="modal-payment">
    <div class="modals1">
        <h2>Payment Method</h2>
        <h6>Scan to pay</h6>
        <img src="../assets/QR.png" class="qr" alt="" width="30%" height="45%">
        <h4 class="amount">Amount: <span id="amountValue">1500</span></h4>
        <p>We accept Gcash only. After scanning the QR code, please put the receipt in the box given.</p>
        <form id="paymentForm" action="./includes/clientPay.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="amount" name="amount" id="amount" value="">
            <input type="hidden" class="transID" name="transID" id="transID" value="">
            <input type="file" id="myFile" name="img1" required>
            <input type="hidden" name="uID" id="uID">
            <div class="order-btn">
                <button type="submit" class="btnSubmit">Submit</button>
                <button type="button" class="btnBack">Back</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url: 'http://localhost/tiago/server/includes/getCMS.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.error) {
                    $('#cms-title').text('Error loading title');
                } else {
                    $('.qr').attr('src', 'http://localhost/tiago/server/includes/uploads/' + data.qr).show();
                }
            },
            error: function () {
                $('#cms-title').text('Error loading data');
            }
        });
        $.ajax({
            url: './includes/getOrders.php',
            type: 'GET',
            dataType: 'json',
            success: function (orders) {
                console.log(orders);
                $.each(orders, function (index, order) {
                    var itemTitles = order.items.map(item => item.title).join(', ');
                    var itemSizes = order.items.map(item => item.size).join('<br>');
                    var totalQuantity = order.total_quantity;
                    var totalPrice = order.total_price;
                    var shipping = order.shipping;
                    var discount = order.discount;
                    if (discount == 'discount') {
                        totalPrice -= totalPrice * 0.1;
                    }
                    if (order.status === 'Pending') {
                        var orderItem = `
                    <div class="order-item">
                        <div class="item-details">
                            <img src="../server/includes/uploads/${order.first_img}" alt="Product Image" style="width: 100px; height: auto;">
                            <h5>Transaction ID: ${order.transaction_id}</h5>
                            <p>Items: <br> ${itemTitles}</p>
                            <p>Sizes: <br> ${itemSizes}</p>
                            <p>Total Quantity: ${totalQuantity}</p>
                        </div>
                        <div class="item-status">
                            <p class="status ${order.status.toLowerCase()}">${order.status}</p>
                        </div>
                        <div class="item-price">
                            <p>Total Price: ₱${totalPrice.toFixed(2)}</p>
                        </div>
                        <div class="item-action">
                            <button class="pay-button" data-total="${totalPrice}" data-transaction="${order.transaction_id}">Pay Now</button>
                            <button class="cancel-button" data-transaction="${order.transaction_id}">Cancel</button>
                        </div>
                    </div>`;
                        $('#to-pay').append(orderItem);
                        var modalBtn = document.querySelector('.pay-button');
                        var modalBg = document.querySelector('.modal-payment');
                        var modalClose = document.querySelector('.btnBack');
                        modalBtn.addEventListener('click', function () {
                            modalBg.classList.add('modal-active');
                        });
                        modalClose.addEventListener('click', function () {
                            modalBg.classList.remove('modal-active');
                        });
                    }
                });
                $('.pay-button').on('click', function () {
                    $('.modal-payment').addClass('modal-active');
                    var transactionId = $(this).data('transaction');
                    var amount = $(this).data('total');
                    $('.amount').val(`${amount}`);
                    $('#transID').val(transactionId);
                });
                $('.btnSubmit').on('click', function (e) {
                    e.preventDefault();
                    var transactionId = $('#transID').val();
                    var amount = $('#amount').val();
                    var myFile = $('#myFile').val();
                    if (!transactionId || !amount || !myFile) {
                        alert('Please fill in all required fields.');
                        return;
                    }
                    $.ajax({
                        url: './includes/updateStatus.php',
                        type: 'POST',
                        data: {
                            transaction_id: transactionId,
                            type: 'payment'
                        },
                        success: function (response) {
                            alert('Success, please wait for an admin to verify your payment. It may take 30 minutes or more');
                            $('#paymentForm').submit();
                        },
                        error: function (xhr, status, error) {
                            console.error('Error updating status:', error);
                        }
                    });
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching orders:', error);
            }
        });
    });
</script>
</body>

</html>
<style>
    body {
        background-color: #f0f0f5;
    }

    .container p {
        color: black;
    }

    .container p:hover {
        cursor: default;
    }

    .container {
        max-width: 1500px;
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

    .item-details p {
        color: black;
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
    .pay-button,
    .cancel-button {
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

    .pay-button:hover,
    .cancel-button:hover {
        opacity: 0.9;
    }

    .order-selection h3 {
        font-weight: bold;
    }

    .item-details p {
        font-size: small;
    }

    .btnCheckout,
    .btnCancel,
    .btnBack,
    .btnSubmit {
        padding: 10px 20px;
        background-color: green;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100px;
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

    .modals1 {
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

    .order-btn {
        margin-bottom: 10px;
        margin-top: 5%;
        justify-content: space-around;
    }
</style>
<?php
include '../test/newFooter.php';
?> 