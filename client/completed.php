<?php
include './header.php';
?>


<!-- Main Content -->
<div class="container">
    <!-- Order Tabs -->
    <div class="tabs">
        <button class="tab-button" onclick="window.location.href='toPay.php'">To Pay</button>
        <button class="tab-button" onclick="window.location.href='toReceived.php'">To Receive</button>
        <button class="tab-button active" onclick="window.location.href='completed.php'">Completed</button>
        <button class="tab-button" onclick="window.location.href='cancelled.php'">Cancelled</button>
    </div>

    <!-- Completed Orders Section -->
    <div class="order-section" id="completed">

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
        <textarea class="comments" name="comments" id="comments" rows="10"
            placeholder="Share more thoughts on the products to help other buy."></textarea>
        <div class="order-btn">
            <button class="btnSubmitReview">Submit</button>
            <button class="btnCancel">Cancel</button>
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
            var hasOrders = false;
            $.each(orders, function (index, order) {
                var itemTitles = order.items.map(item => item.title).join(', ');
                var itemSizes = order.items.map(item => item.size).join('<br>');
                var totalQuantity = order.total_quantity;
                var totalPrice = order.total_price;
                if (order.status === 'Completed') {
                    hasOrders = true;
                    var orderItem = `
                    <div class="order-item">
                        <div class="item-details">
                            <img src="../server/includes/uploads/${order.first_img}" alt="Product Image" style="width: 100px; height: auto;">
                            <div>
                                <h5>${itemTitles}</h5>
                                <p>Size: <br>${itemSizes}</p>
                                <p>Quantity: ${totalQuantity}</p>
                                <p>Total Items: ${totalQuantity}</p>
                            </div>
                        </div>
                        <div class="item-status">
                            <p class="status completed">${order.status}</p>
                        </div>
                        <div class="item-price">
                            <p>₱${totalPrice.toFixed(2)}</p>
                        </div>
                        <div class="item-actions">
                            <button data-id="${order.transaction_id}" class="confirm-receive-btn">Write Review</button>
                        </div>
                    </div>`;
                    $('#completed').append(orderItem);
                }
            });
            if (!hasOrders) {
                $('#completed').append('<br><h1>No Completed Orders Yet</h1>');
            }
            $('.confirm-receive-btn').on('click', function () {
                var transactionId = $(this).data('id'); 
                alert("You can implement review functionality for Transaction ID: " + transactionId);
                var modalBg = $('.modal-review');
                modalBg.addClass('modal-active');
            });
            $('.btnCancel').on('click', function () {
                var modalBg = $('.modal-review');
                modalBg.removeClass('modal-active');
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
    .comments {
        margin-bottom: 10px;
        width: 500px;
    }

    body {
        background-color: #f0f0f5;
    }

    .container p {
        color: black;
    }

    .container p:hover {
        cursor: default;
    }

    textarea {
        padding-left: 10px;
    }

    .order-btn {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        align-items: center;
    }

    .modals .btnSubmitReview {
        padding: 10px 20px;
        background-color: green;
        width: 200px;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        /* Add this line */
    }

    .modals .btnCancel {
        padding: 10px 20px;
        background-color: #f44336;
        width: 200px;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .modal-review {
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

    .modals {
        background-color: white;
        width: auto;
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

    /* Completed status */
    .status.completed {
        color: green;
        font-weight: bold;
    }

    /* Button styles for "Confirm Receipt" */
    .confirm-receive-btn {
        margin-left: 10px;
        background-color: #0066cc;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .item-details p {
        font-size: small;
    }

    .confirm-receive-btn:hover {
        background-color: #004c99;
    }

    .checked {
        color: orange;
    }
</style>

<?php
include '../test/newFooter.php';
?>