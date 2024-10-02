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
                    <button class="decline-btn">Decline</button>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- End Main -->
 <script>
    document.addEventListener('DOMContentLoaded', function(){
        //Websocket connection
        var conn = new WebSocket('ws://localhost:8080');
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
    .decline-btn {
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .accept-btn {
        background-color: #28a745;
        color: white;
    }

    .decline-btn {
        background-color: #dc3545;
        color: white;
    }
</style>

<!-- Scripts -->
<script>
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
</body>
</html>
