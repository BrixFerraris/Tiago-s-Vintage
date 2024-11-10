<?php
include './header.php';
?>

<!-- Main Content -->
<div class="container">
    <!-- Order Tabs -->
    <div class="tabs">
        <button class="tab-button" onclick="window.location.href='toPay.php'">To Pay</button>
        <button class="tab-button active" onclick="window.location.href='toReceived.php'">To Receive</button>
        <button class="tab-button" onclick="window.location.href='completed.php'">Completed</button>
        <button class="tab-button" onclick="window.location.href='cancelled.php'">Cancelled</button>
    </div>

    <div class="order-section" id="to-pay">
        <!-- To Receive Section -->
        <h4>My Orders - To Receive</h4>
        <div class="orders-container">
            <!-- Order items will be dynamically inserted here -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
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
                    if (order.status === 'Ready For Pickup') {
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
                            <p class="status to-receive">${order.status}</p>
                        </div>
                        <div class="item-price">
                            <p>Total Price: ₱${totalPrice.toFixed(2)}</p>
                        </div>
                        <div class="item-action">
                            <button data-id="${order.transaction_id}" class="confirm-receive-btn">Order Received</button>
                        </div>
                    </div>`;
                        $('#to-pay').append(orderItem);
                    } else {
                        $('#to-pay').append('<br><h1>No Orders Yet</h1>');
                    }
                    $('.confirm-receive-btn').on('click', function () {
                        var transactionId = $(this).data('id'); 
                        $.ajax({
                            url: './includes/updateStatus.php',
                            type: 'POST',
                            data: {
                                transaction_id: transactionId,
                                type: 'complete'
                            },
                            success: function (response) {
                                var result = JSON.parse(response);
                                    alert("Completed transaction. Thank you!"); 
                                    location.reload(); 
                            },
                            error: function (xhr, status, error) {
                                console.error('Error updating status:', error);
                                alert('An error occurred while updating the status.');
                            }
                        });
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

    /* To Receive status */
    .status.to-receive {
        color: #0066cc;
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

    .confirm-receive-btn:hover {
        background-color: #004c99;
    }

    .item-details p {
        font-size: small;
    }
</style>
<?php
include '../test/newFooter.php';
?>