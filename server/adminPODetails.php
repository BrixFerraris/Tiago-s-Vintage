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
    header("location: ./adminLogin.php?error=NotLoggedIn");
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
        <img id="imageReceipt" src="" alt="Receipt" width="30%" height="45%">
        <h4 id="amountDisplay">Amount: </h4>
        <button class="btnBack">Back</button>
    </div>
</div>

<div class="modal-cancel">
    <div class="modals">
        <h2>Reason for Cancelation:</h2>
        <textarea id="cancelReason" placeholder="Enter your reason here..." rows="20" cols="50"></textarea>
         <div class="btnss">
            <button class="btnSubmit">Submit</button>
            <button class="btnBack">Back</button>
         </div>
    </div>
</div>

<div class="modal-replace">
    <div class="modals">

        <h2>Request for replacement:</h2>

        <label for="Issue">
            <h3>Issue</h3>
            <br>
            <p>SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE</p>
        </label>
        

        <label for="description">
            <h3>Description</h3>
            <br>
            <p> SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE
                SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE
                SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE SAMPLESAMPLE</p>
        </label>
        

        <div class="media-preview" id="photoPreview">
        <!-- dito nakalagay yung image na nilagay ng cutomer -->
        <figure class="image" >
          <img src="../assets/tiagos-removebg-preview 1.png">
          <img src="../assets/tiagos-removebg-preview 1.png">
        </figure>
        </div>

         <div class="btnss">
            <button class="btnBack">Back</button>
         </div>
    </div>
</div>






<!-- Scripts -->
<script>
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
					console.log(payment.receipt);
					$('#imageReceipt').attr('src', '../client/includes/uploads/' + payment.receipt).show();
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
        $.ajax({
            url: '../serverFunctions.php',
            type: 'POST',
            data: { type: 'loadPODetails', transaction_id: transactionId },
            dataType: 'json',
            success: function (data) {
                console.log(data.status);
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
                <p><strong>Email</strong><br><span id="email">${data.username}</span><br></p>
                <p><strong>Contact No.</strong><br><span id="contact">${data.contact}</span></p>
                <p><strong>Discount / Freebie</strong><br><span id="">${data.discount}</span><br></p>
                <p><strong>Shipping</strong><br><span id="">${data.shipping}</span><br></p>
            `;

                let buttonsHTML = '';
                if (data.status === 'Check Payment') {
                    buttonsHTML = `
                    <button data-shipping="${data.shipping}" data-id="${transactionId}" class="btn-accept accept-btn">Accept</button>
                    <button class="show-btn">Show Receipt</button>

                    <button class="show-replace-btn">Show Replace Info</button>


                    <button data-id="${transactionId}" class="decline-btn">Decline</button>
                `;
                } else if (data.status === 'Ready For Pickup') {
                    buttonsHTML = `
                    <button class="show-btn">Show Receipt</button>
                    <button data-id="${transactionId}" data-user="${data.username}" class="btn-complete accept-btn">Complete</button>
                `;
                } else if (data.status === 'Out For Delivery') {
                    buttonsHTML = `
                    <button class="show-btn">Show Receipt</button>
                    <button data-points="${data.points}" data-id="${transactionId}" data-user="${data.username}" class="btn-complete accept-btn">Complete</button>
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
                $(document).on('click', '.btn-accept', function () {
                    var transactionId = $(this).data('id');
                    var shipping = $(this).data('shipping');
                    $.ajax({
                        url: './includes/acceptOrder.php',
                        type: 'POST',
                        data: {
                            shipping: shipping,
                            transaction_id: transactionId,
                            action: 'accept'
                        },
                        success: function (response) {
                            var res = JSON.parse(response);
                            if (res.success) {
                                alert(`Order ${transactionId} accepted successfully`);
                                $.ajax({
                                    url: './includes/sendReminder.php',
                                    type: 'POST',
                                    data: {
                                        transaction_id: transactionId
                                    },
                                    success: function (reminderResponse) {
                                        var reminderRes = JSON.parse(reminderResponse);
                                        if (reminderRes.status) {
                                            alert('Reminder email sent successfully!');
                                        } else {
                                            alert('Error sending reminder: ' + reminderRes.error);
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        console.error('An error occurred while sending reminder:', error);
                                        alert('Error sending reminder. Please try again later.');
                                    }
                                });
                                window.location.href = './purchaseOrders.php';
                            } else {
                                alert('Error accepting order: ' + res.error);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('An error occurred:', error);
                            alert('Error updating order status. Please try again later.');
                        }
                    });
                });

                $(document).on('click', '.btn-complete', function () {
                    var transactionId = $(this).data('id');
                    var username = $(this).data('user');
                    $.ajax({
                        url: './includes/acceptOrder.php',
                        type: 'POST',
                        data: {
                            transaction_id: transactionId,
                            action: 'complete',
                            username: username
                        },
                        success: function (response) {
                            alert("Success");  
                        },
                        error: function (xhr, status, error) {
                            console.error('An error occurred:', error);
                            alert('Error updating order status. Please try again later.');
                        }
                    });
                });



                    // Modal for Receipt
                    var modalBtn1 = document.querySelector('.show-btn');
                    var modalBg1 = document.querySelector('.modal-receipt');
                    var modalClose1 = modalBg1.querySelector('.btnBack');

                    modalBtn1.addEventListener('click', function () {
                        modalBg1.classList.add('modal-active');
                    });
                    modalClose1.addEventListener('click', function () {
                        modalBg1.classList.remove('modal-active');
                    });
                    
                    // Modal for cancel
                    var modalBtn2 = document.querySelector('.decline-btn');
                    var modalBg2 = document.querySelector('.modal-cancel');
                    var modalClose2 = modalBg2.querySelector('.btnBack');

                    modalBtn2.addEventListener('click', function () {
                        modalBg2.classList.add('modal-active');
                    });
                    modalClose2.addEventListener('click', function () {
                        modalBg2.classList.remove('modal-active');
                    });


                    // Modal for Replace
                    var modalBtn3 = document.querySelector('.show-replace-btn');
                    var modalBg3 = document.querySelector('.modal-replace');
                    var modalClose3 = modalBg3.querySelector('.btnBack');

                    modalBtn3.addEventListener('click', function () {
                        modalBg3.classList.add('modal-active');
                    });
                    modalClose3.addEventListener('click', function () {
                        modalBg3.classList.remove('modal-active');
                    });

                $('.btnSubmit').click(function () {
                    var transactionId = $(this).data('id');
                    $.ajax({
                        url: './includes/acceptOrder.php',
                        type: 'POST',
                        data: {
                            transaction_id: transactionId,
                            action: 'decline'
                        },
                        success: function (response) {
                            const result = JSON.parse(response);
                            if (result.success) {
                                alert(`Order ${transactionId} declined successfully`);
                                window.location.href = './purchaseOrders.php';
                            } else {
                                alert(result.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('An error occurred:', error);
                            alert('Error updating order status. Please try again later.');
                        }
                    });
                });
            }
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
    .show-replace-btn,
    .btnBack,
    .btnSubmit {
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .accept-btn,
    .btnSubmit {
        background-color: #28a745;
        color: white;
    }

    .show-btn, .show-replace-btn {
        background-color: #0035d6;
        color: white;
    }

    .decline-btn {
        background-color: #dc3545;
        color: white;
    }




    /* modal */
    .modal-receipt, .modal-replace {
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

    .modal-cancel {
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

    .modal-cancel .modals{
        background-color: white;
        width: 30%;
        height: 50%;
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-direction: column;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    
    .modal-replace .modals {
        background-color: white;
        width: 50%;
        height: 70%;
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

    .modal-replace .modals label{
        width: 80%;
        height: auto;
    } 

    .image img{
        height: 100px; 
        width: 100px;
    }
   /* Media Query for Laptops */
@media (min-width: 1025px) and (max-width: 1440px) {
    .order-container {
        flex-direction: row;
        padding: 15px;
    }

    .order-items-container,
    .order-summary {
        width: 48%;
    }

    .order-items-container {
        padding: 15px;
    }

    .order-summary {
        padding: 15px;
    }

    .item-img {
        width: 80px;
    }
}

/* Media Query for Tablets */
@media (min-width: 768px) and (max-width: 1024px) {
    .order-container {
        flex-direction: column;
        padding: 15px;
    }

    .order-items-container,
    .order-summary {
        width: 90%;
        margin: 10px auto;
    }

    .order-items-container {
        padding: 10px;
    }

    .order-summary {
        padding: 10px;
    }

    .item-img {
        width: 70px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 10px;
    }
}

/* Media Query for Mobile Devices */
@media (max-width: 767px) {
    .order-container {
        flex-direction: column;
        padding: 10px;
    }

    .order-items-container,
    .order-summary {
        width: 95%;
        margin: 10px auto;
    }

    .order-items-container {
        padding: 8px;
    }

    .order-summary {
        padding: 8px;
    }

    .item-img {
        width: 60px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 8px;
    }

    .modals {
        width: 90%;
        height: auto;
        padding: 15px;
    }

    .modals img {
        width: 150px;
        height: auto;
    }

    .btnBack {
        width: 100%;
    }
}

</style>

</html>