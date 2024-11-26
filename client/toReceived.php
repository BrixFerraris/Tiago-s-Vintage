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
                $('.item-action').empty();

                $.each(orders, function (index, order) {
                    var itemTitles = order.items.map(item => item.title).join(', ');
                    var itemSizes = order.items.map(item => item.size).join('<br>');
                    var totalQuantity = order.total_quantity;
                    var totalPrice = order.grandtotal;
                    if (order.status === 'Ready For Pickup' || order.status === 'Check Payment' || order.status === 'Out For Delivery') {
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
                                    <p>Total Price: ₱${totalPrice}</p>
                                </div>
                                <div class="item-action">
                                </div>
                            </div>`;
                        $('#to-pay').append(orderItem);
                        var lastItemAction = $('#to-pay .order-item:last .item-action');
                        if (order.status === 'Ready For Pickup' || order.status === 'Out For Delivery') {
                            lastItemAction.append(`<button data-id="${order.transaction_id}" data-points=${order.points} class="confirm-receive-btn">Order Received</button>`);
                        } else if (order.status === 'Check Payment') {
                            lastItemAction.append('<p>Waiting for admin to confirm payment</p>');
                        }
                    }
                $('.confirm-receive-btn').on('click', function () {
                    var transactionId = $(this).data('id');
                    var points = $(this).data('points');
                    $.ajax({
                        url: './includes/updateStatus.php',
                        type: 'POST',
                        data: {
                            transaction_id: transactionId,
                            type: 'complete',
                            points:parseInt(points)
                        },
                        success: function (response) {
                            var result = JSON.parse(response);
                            alert("Completed transaction. Thank you!");
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

    /* Tablet (max-width: 768px) */
    @media (max-width: 768px) {
        .container {
            max-width: 95%;
            padding: 15px;
        }

        .menu {
            flex-direction: column;
            align-items: center;
        }

        .menu li {
            margin: 10px 0;
        }

        .tabs {
            flex-wrap: wrap;
            justify-content: center;
            width: 20px;
        }

        .tab-button {
            font-size: 14px;
            padding: 8px 15px;
        }

        .order-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .item-details img {
            width: 70px;
            height: 70px;
            margin-bottom: 10px;
        }

        .item-status,
        .item-price,
        .item-actions {
            width: 100%;
            text-align: left;
        }

        .confirm-receive-btn {
            width: 100%;
            margin-top: 10px;
        }
    }

    /* Mobile (max-width: 425px) */
    @media (max-width: 425px) {
        .container {
            margin: 10px auto;
            padding: 10px;
        }

        .menu {
            flex-direction: column;
        }

        .menu a {
            font-size: 14px;
        }

        .tabs {
            flex-direction: column;
            margin-bottom: 10px;
        }

        .tab-button {
            font-size: 12px;
            padding: 6px 10px;
        }

        .order-item {
            padding: 10px 0;
        }

        .item-details img {
            width: 60px;
            height: 60px;
        }

        .item-details p {
            font-size: x-small;
        }

        .confirm-receive-btn {
            font-size: 12px;
            padding: 6px 10px;
        }
    }
</style>
<?php
include '../test/newFooter.php';
?>