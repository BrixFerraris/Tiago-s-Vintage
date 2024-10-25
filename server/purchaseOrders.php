<?php
  include_once './includes/sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/purchaseOrders.css">
    <title>Purchase Orders</title>
</head>
<body>
<main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">PURCHASE ORDERS</p>
        </div>

        <div class="content">
            <table id="products" >
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Buyer's Name</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Accept</th>
                        <th>Decline</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PO12345</td>
                        <td>Alex Cueto</td>
                        <td>Imus, Cavite</td>
                        <td>Pending</td>
                        <td><button class="accept-btn">Accept</button></td>
                        <td><button class="delete-btn">Delete</button></td>
                    </tr>
                    <!-- Add additional product rows here -->
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="pagination">
                <a href="#" class="prev">Previous</a>
                <a href="#" class="page-num">1</a>
                <a href="#" class="page-num">2</a>
                <a href="#" class="next">Next</a>
            </div>
      <!-- End Main -->
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            //Websocket connection
            var conn = new WebSocket('ws://65.19.154.77:6969/ws/');
            var table = document.getElementById('products');
            conn.onopen = function() {
                conn.send(JSON.stringify({ type: 'loadPurchaseOrders' }));
            };
            conn.onmessage = function(e) { 
                var purchaseOrder = JSON.parse(e.data);
                const rows = {};
                if (purchaseOrder.type === 'purchase-order') {
                let rowExists = false;
                for (let i = 0; i < table.rows.length; i++) {
                    if (table.rows[i].cells[0].innerHTML === purchaseOrder.transaction_id) {
                        rowExists = true;
                        break;
                    }
                }
                if (!rowExists) {
                    var newRow = table.insertRow();
                    newRow.insertCell().innerHTML = purchaseOrder.transaction_id;
                    newRow.insertCell().innerHTML = purchaseOrder.firstName + ' ' + purchaseOrder.lastName;
                    newRow.insertCell().innerHTML = purchaseOrder.address;
                    newRow.insertCell().innerHTML = purchaseOrder.status;
                    newRow.insertCell().innerHTML = `<button class="accept-btn">Accept</button>`;
                    newRow.insertCell().innerHTML = `<button class="delete-btn">Delete</button>`;
                    newRow.addEventListener('click', function() {
                    window.location.href = 'adminPODetails.php?transaction_id=' + purchaseOrder.transaction_id;
                    });
                }
            }
            };
        });
    </script>
</body>
</html>
