<?php
session_start();

if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    if ($role === 'Super Admin') {
        include_once './includes/sidebar.php';
    } elseif ($role === 'Accept Orders') {
        include_once './includes/sidebarAccept_Order.php.php';
    } else {
        header("location: adminDashboard.php");
        exit();
    }
} else {
    header("location: ../landing.php?error=NotLoggedIn");
    exit();
}
?>

<!-- Main -->
<main class="main-container">
    <div class="main-title">
        <p class="font-weight-bold">Order Detail</p>
    </div>

    <!-- Order Detail Layout -->
    <div class="order-container">
        <!-- Left side (Order Items in a container) -->
        <div class="order-items-container">

        </div>

        <!-- Right side (Customer Details with buttons at the bottom) -->
        <div class="order-summary">

        </div>
    </div>
</main>
</body>
<div class="modal-receipt">
    <div class="modals">
        <h2>Customer's Receipt</h2>
        <img id="receiptImage" src="" alt="Receipt" width="30%" height="45%">
        <h4 id="amountDisplay">Amount: </h4>
        <button class="btnBack">Back</button>
    </div>
</div>




<!-- Custom Styles -->
<style>
    .main-container {
        padding: 20px;
    }

    .order-container {
        display: flex;
        justify-content: space-between;
        background-color: #f1f2f6;
        padding: 20px;
        border-radius: 8px;
    }

    .order-items-container {
        width: 60%;
        background-color: white;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .order-items {
        display: flex;
        flex-direction: column;
    }

    .item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .item-img {
        width: 100px;
        height: auto;
        margin-right: 20px;
    }

    .item-detail {
        line-height: 1.5;
    }

    .item-name {
        font-weight: bold;
    }

    .order-total {
        font-size: 18px;
        font-weight: bold;
        margin-top: 20px;
    }

    .order-summary {
        width: 35%;
        background-color: white;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .summary-actions {
        margin-top: auto;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
    }

    .accept-btn,
    .decline-btn,
    .show-btn,
    .btnBack {
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .accept-btn {
        background-color: #28a745;
        color: white;
    }

    .show-btn {
        background-color: #0035d6;
        color: white;
    }

    .decline-btn {
        background-color: #dc3545;
        color: white;
    }




    /* modal */
    .modal-receipt {
        position: fixed;
        width: 100%;
        height: 100%;
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

    .modals img {
        width: 220px;
        height: 340px;
        object-fit: contain;
    }

    .modals {
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

    .btnBack {
        margin-top: auto;
        justify-content: space-around;
        background-color: #dc3545;
        color: white;
    }
</style>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var conn = new WebSocket('ws://localhost:8080/ws/');
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);
        const transactionId = params.get('transaction_id');
        conn.onopen = function (e) {
            conn.send(JSON.stringify({ type: 'loadPODetails', transaction_id: transactionId }));
        };
        conn.onmessage = function (e) {
            const data = JSON.parse(e.data);
            console.log(data);
            const orderItemsContainer = document.querySelector('.order-items-container');
            const orderItems = data.order_items;
            orderItemsContainer.innerHTML = '';
            orderItems.forEach((item) => {
                const itemHTML = `
                    <div class="item">
                        <img src="./includes/uploads/${item.img1}" alt="${item.title}" class="item-img">
                        <div class="item-detail">
                            <p class="item-name">${item.title}</p>
                            <p>x${item.quantity}</p>
                            <p>₱${item.price}</p>
                        </div>
                    </div>
                `;
                orderItemsContainer.innerHTML += itemHTML;
            });
            const orderTotal = data.order_total;
            const orderTotalHTML = `
                <div class="order-total">
                    <p>Order Total: ₱${orderTotal}</p>
                </div>
            `;
            orderItemsContainer.innerHTML += orderTotalHTML;
            const summaryContainer = document.querySelector(".order-summary");
            let orderHTML = `
                <p><strong>Order Number</strong><br><span id="trans_num">${transactionId}</span></p>
                <p><strong>Name</strong><br><span id="customerName">${data.name}</span></p>
                <p><strong>Address</strong><br><span id="address">${data.address}</span><br></p>
                <p><strong>Shipping Method</strong><br><span id="">delivery</span><br></p>
                <p><strong>Discount / Freebie</strong><br><span id="">discount or freebie or None</span><br></p>
                <p><strong>Contact No.</strong><br><span id="contact">${data.contact}</span></p>
            `;
            let buttonsHTML = '';
            if (data.status === 'Check Payment') {
                buttonsHTML = `
                <button data-id="${transactionId}" class="accept-btn">Accept</button>
                <button class="show-btn">Show Receipt</button>
                <button data-id="${transactionId}" class="decline-btn">Decline</button>
            `;
            } else if (data.status === 'Ready For Pickup') {
                buttonsHTML = `
                <button class="show-btn">Show Receipt</button>
                <button data-id="${transactionId}" class="decline-btn">Decline</button>
            `;
            } else if (data.status === 'Pending') {
                buttonsHTML = `<h1>Wait for customer's payment</h1>`;
            } else {
                buttonsHTML = `<h1>Order status: ${data.status}</h1>`;
            }
            summaryContainer.innerHTML = orderHTML + `
            <div class="summary-actions">
                <div class="action-buttons">
                    ${buttonsHTML}
                </div>
            </div>
        `;
            $(document).on('click', '.accept-btn', function () {
                var transactionId = $(this).data('id');
                $.ajax({
                    url: './includes/acceptOrder.php',
                    type: 'POST',
                    data: { transaction_id: transactionId },
                    success: function (response) {
                        alert(`Order ${transactionId} accepted successfully`);
                        window.location.href = './purchaseOrders.php';
                    },
                    error: function (xhr, status, error) {
                        console.error('An error occurred:', error);
                        alert('Error updating order status. Please try again later.');
                    }
                });
            });
            $('.show-btn').click(function () {
                $('.modal-receipt').addClass('modal-active');
            });
        };
        conn.onerror = function (error) {
            console.error('WebSocket Error:', error);
        };
        conn.onclose = function (event) {
            console.log('WebSocket connection closed:', event);
        };
    });
    $(document).ready(function () {
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);
        const transactionId = params.get('transaction_id');
        $.ajax({
            url: './includes/getPayments.php',
            type: 'GET',
            data: { transaction_number: transactionId },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.length > 0) {
                    const payment = data[0];
                    $('#receiptImage').attr('src', `../client/includes/uploads/${payment.receipt}`);
                    $('#amountDisplay').text(`Amount: ₱${payment.amount}`);
                    $('.modal-receipt').show();
                } else {
                    console.error('No payment data found for this transaction.');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
        $('.btnBack').on('click', function () {
            $('.modal-receipt').hide();
        });
    });

    // modal




    // SIDEBAR TOGGLE
    let sidebarOpen = false;
    const sidebar = document.getElementById('sidebar');

    function openSidebar() {
        if (!sidebarOpen) {
            sidebar.classList.add('sidebar-responsive');
            sidebarOpen = true;
        }
    }

    function closeSidebar() {
        if (sidebarOpen) {
            sidebar.classList.remove('sidebar-responsive');
            sidebarOpen = false;
        }
    }


</script>

</html>