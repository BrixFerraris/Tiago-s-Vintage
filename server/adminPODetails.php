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
            <div class="order-items">
                <div class="item">
                    <img src="images/davey-allison-shirt.png" alt="Davey Allison 28 Big Print" class="item-img">
                    <div class="item-detail">
                        <p class="item-name">Davey Allison 28 Big Print</p>
                        <p>25W X 35L (Large)</p>
                        <p>x1</p>
                        <p>₱1500</p>
                    </div>
                </div>

                <div class="item">
                    <img src="images/essential-shirt.png" alt="Essential Shirt" class="item-img">
                    <div class="item-detail">
                        <p class="item-name">Essential Shirt</p>
                        <p>25W X 35L (Large)</p>
                        <p>x1</p>
                        <p>₱1500</p>
                    </div>
                </div>

                <div class="item">
                    <img src="images/holy-spirit-shirt.png" alt="Holy Spirit Kanye West Shirt" class="item-img">
                    <div class="item-detail">
                        <p class="item-name">Holy Spirit Kanye West Shirt</p>
                        <p>25W X 35L (Large)</p>
                        <p>x1</p>
                        <p>₱1500</p>
                    </div>
                </div>

                <div class="order-total">
                    <p>Order Total: ₱4500</p>
                </div>
            </div>
        </div>

        <!-- Right side (Customer Details with buttons at the bottom) -->
        <div class="order-summary">
            <p><strong>Order Number</strong><br>PO00001</p>
            <p><strong>Name</strong><br>Juan Dela Cruz</p>
            <p><strong>Address</strong><br>500 Villa Nicasia 4 Bayan<br>Iuma 23 Imus Cavite, 4103</p>
            <p><strong>Contact No.</strong><br>(+63) 9772954101</p>

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
        conn.onopen = function(e) {
            conn.send(JSON.stringify({ type: 'loadProducts' }));
        };
        conn.onmessage = function(e) {
            var product = JSON.parse(e.data);
            if (product.type === 'product') {
                var table = document.getElementById('products').getElementsByTagName('tbody')[0];
                var newRow = table.insertRow();
            }
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
