<?php
include './header.php';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

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
        <img src="../assets/QR.png" class="qr" alt="" width="180px" height="210px">
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
        var userRole = "<?php echo $role; ?>";
        if (userRole !== 'Customer' && userRole !== '') {
            window.location.href = "../server/adminDashboard.php";
        }
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
                    var varID = order.items.map(item => item.variationID).join('<br>');
                    var quantity = order.items.map(item => item.quantity).join('<br>');
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
                            <p>Transaction ID: ${order.transaction_id}</p>
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
                            <button class="cancel-button" data-quantity="${quantity}" data-variation="${varID}" data-transaction="${order.transaction_id}">Cancel</button>
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
                    $('#amountValue').text(amount);
                });
                $(document).on('click', '.cancel-button', function () {
                    var transactionId = $(this).data('transaction');
                    var allVarID = $(this).data('variation');
                    var allQuantities = $(this).data('quantity');

                    allVarID = String(allVarID);
                    allQuantities = String(allQuantities);

                    if (typeof allVarID !== 'string') {
                        alert("Variation data is not a string. Actual value: " + allVarID);
                        return;
                    }

                    if (typeof allQuantities !== 'string') {
                        alert("Quantity data is not a string. Actual value: " + allQuantities);
                        return;
                    }

                    allVarID = allVarID.includes('<br>') ? allVarID.split('<br>') : [allVarID];
                    allQuantities = allQuantities.includes('<br>') ? allQuantities.split('<br>') : [allQuantities];

                    if (allVarID.length !== allQuantities.length) {
                        alert("Variation IDs and quantities do not match.");
                        return; 
                    }

                    $.ajax({
                        url: './includes/updateStatus.php',
                        type: 'POST',
                        data: {
                            transaction_id: transactionId,
                            type: 'cancel'
                        },
                        success: function (response) {
                            var result = JSON.parse(response);
                            if (result.status === 'success') {
                                alert("Cancelled successfully");
                                var variationData = [];
                                for (var i = 0; i < allVarID.length; i++) {
                                    variationData.push({
                                        id: allVarID[i],
                                        quantity: allQuantities[i]
                                    });
                                }
                                $.ajax({
                                    url: './includes/updateVariation.php',
                                    type: 'POST',
                                    data: {
                                        variations: variationData 
                                    },
                                    success: function (quantityResponse) {
                                        var quantityResult = JSON.parse(quantityResponse);
                                        if (quantityResult.status === 'success') {
                                            window.location.href = './cancelled.php';
                                        } else {
                                            alert("Error updating quantities: " + quantityResult.message);
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        console.error('Error updating quantities:', error);
                                        alert('Failed to update quantities. Please try again later.');
                                    }
                                });
                            } else {
                                alert("Error: " + result.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error updating status:', error);
                            alert('Failed to update status. Please try again later.');
                        }
                    });
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
                            var res = JSON.parse(response);
                            alert('Success, please wait for an admin to verify your payment. It may take 30 minutes or more');
                            $.ajax({
                                url: './includes/updateVariation.php',
                                type: 'POST',
                                success: function (deleteResponse) {
                                    console.log('Variations updated:', deleteResponse);
                                    window.location.href = './toReceived.php';
                                },
                                error: function (xhr, status, error) {
                                    console.error('Error updating variations:', error);
                                }
                            });
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
        /* Align items to the left for scrolling */
        gap: 10px;
        /* Space between buttons */
        overflow-x: auto;
        /* Enable horizontal scrolling */
        padding: 10px;
        white-space: nowrap;
        /* Prevent buttons from wrapping */
        border-bottom: 1px solid #ddd;
        /* Optional: underline for aesthetics */
    }

    .tabs::-webkit-scrollbar {
        height: 8px;
        /* Height of the scrollbar */
    }

    .tabs::-webkit-scrollbar-thumb {
        background: #ccc;
        /* Scrollbar color */
        border-radius: 4px;
    }

    .tabs::-webkit-scrollbar-thumb:hover {
        background: #bbb;
        /* Scrollbar hover color */
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
        max-width: auto;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
        /* Enable horizontal scrolling */
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding: 15px 0;
        flex-wrap: wrap;
        /* Allow wrapping on smaller screens */
    }

    .item-details {
        display: flex;
        align-items: center;
        flex: 1 1 60%;
        /* Flex item that adjusts on smaller screens */
        min-width: 200px;
        /* Ensure minimum space for smaller screens */
    }

    .item-details img {
        width: 80px;
        height: 80px;
        margin-right: 15px;
    }

    .item-details p {
        color: black;
        font-size: small;
    }

    .item-status,
    .item-price {
        width: 100px;
        text-align: center;
        flex: 1 1 auto;
    }

    .item-action {
        display: flex;
        gap: 10px;
        flex: 1 1 auto;
        margin-top: 10px;
        /* Add spacing for smaller screens */
    }

    .item-action button {
        width: 100px;
    }

    .status.pending {
        color: orange;
        font-weight: bold;
    }

    .pay-button,
    .cancel-button {
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 14px;
        flex: 1;
        /* Buttons take equal width */
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
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.4);
        /* Add semi-transparent background */
        z-index: 999;
        /* Ensure it stays above other elements */
    }

    .modals1 {
        background-color: white;
        width: 50%;
        max-width: 500px;
        /* Limit the maximum width */
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        /* Prevent overflowing content */
    }

    .order-btn {
        display: flex;
        justify-content: space-around;
        width: 100%;
        /* Ensure buttons span the full modal width */
        margin-bottom: 10px;
        margin-top: 5%;
    }

    .order-btn button {
        flex: 1;
        /* Ensure equal button sizes */
        margin: 0 5px;
        /* Add spacing between buttons */
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: #4CAF50;
        color: white;
        font-size: 14px;
    }

    .order-btn button.cancel {
        background-color: #f44336;
    }

    /* Responsive styles */
    @media screen and (max-width: 768px) {
        .modals1 {
            width: 90%;
            /* Take up more space on smaller screens */
            max-width: 400px;
        }

        .order-btn {
            flex-direction: column;
            /* Stack buttons vertically */
        }

        .order-btn button {
            width: 100%;
            /* Buttons fill the width */
            margin: 5px 0;
            /* Add spacing between buttons */
        }
    }

    @media screen and (max-width: 480px) {
        .modals1 {
            padding: 15px;
            /* Reduce padding for smaller screens */
        }

        #myFile {
            margin-top: 20px;
            width: 150px;
            margin-bottom: 10px;
        }

        .order-btn {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .order-btn button {
            font-size: 12px;
            /* Adjust button text size for smaller screens */
            padding: 8px 10px;
            max-width: 100px;
        }
    }

    @media screen and (max-width: 768px) {
        .order-item {
            flex-direction: column;
            align-items: flex-start;
            /* Align items to the left on smaller screens */
        }

        .item-details {
            margin-bottom: 10px;
            /* Add spacing between rows */
        }

        .item-details p {
            margin: 10px;
            /* Add spacing between rows */
        }

        .item-status,
        .item-price {
            width: auto;
            /* Allow flexible width */
            text-align: left;
        }

        .item-action {
            flex-direction: row;
            align-items: flex-start;
        }
    }

    @media (max-width: 768px) {
        .tabs {
            padding: 5px;
        }

        .tab-button {
            font-size: 14px;
            /* Smaller font size for smaller screens */
            padding: 8px 15px;
        }
    }

    @media (max-width: 425px) {
        .tab-button {
            font-size: 12px;
            padding: 5px 10px;
        }
    }
</style>
<?php
include '../test/newFooter.php';
?>