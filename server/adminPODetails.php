<?php
  include_once './includes/sidebar.php';
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
            <p><strong>Order Number</strong><br><span id="trans_num"></span></p>
            <p><strong>Name</strong><br><span id="customerName"></span></p>
            <p><strong>Address</strong><br><span id="address"></span><br></p>
            <p><strong>Contact No.</strong><br><span id="contact"></span></p>

            <!-- Move buttons to the bottom -->
            <div class="summary-actions">
                <div class="action-buttons">
                    <button class="accept-btn">Accept</button>
                    <button class="show-btn">Show Receipt</button>
                    <button class="show-btn">Complete</button>
                    <button class="decline-btn">Decline</button>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
<div class="modal-receipt">
    <div class="modals">

        <h2>Customer's Receipt</h2>
        <img src="../images/sample-receipt.png" alt="" width="30%" height="45%">
        <h4>Amount: 1500 </h4>
      
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

.modals img{
  width: 220px;
  height: 340px;
  object-fit: contain;
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

.btnBack{
    margin-top: 5%;
    justify-content: space-around;
    background-color: #dc3545;
    color: white;
}

    

</style>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function(){
        //Websocket connection
        var conn = new WebSocket('ws://65.19.154.77:8080/ws/');
        const url = new URL(window.location.href);
const params = new URLSearchParams(url.search);
const transactionId = params.get('transaction_id');
console.log(transactionId);

conn.onopen = function(e) {
  conn.send(JSON.stringify({ type: 'loadPODetails', transaction_id: transactionId}));
};

conn.onmessage = function(e) {
  const data = JSON.parse(e.data);
  console.log(data);

  const orderItemsContainer = document.querySelector('.order-items-container');
  const orderItems = data.order_items;

  orderItems.forEach((item, index) => {
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
  var summaryContainer = $(".order-summary");
var customerName = $("#customerName");
var address = $("#address");
var contact = $("#contact");
var trans_number = $("#trans_num");


customerName.text(data.name);
address.text(data.address);
contact.text(data.contact);
trans_number.text(transactionId);
  
  
};
    });


// modal

    var modalBtn = document.querySelector('.show-btn');
    var modalBg = document.querySelector('.modal-receipt');
    var modalClose = document.querySelector('.btnBack');
    
    modalBtn.addEventListener('click', function() {
        modalBg.classList.add('modal-active');
    });
    modalClose.addEventListener('click', function(){
        modalBg.classList.remove('modal-active');
    });


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
