<?php
session_start();

if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    if ($role === 'Super Admin') {
        include_once './includes/sidebar.php';
    } elseif ($role === 'Accept Orders') {
        include_once './includes/sidebarAdd_Product.php';
    } else {
        header("location: adminDashboard.php");
        exit();
    }
} else {
    header("location: ./adminLogin.php?error=NotLoggedIn");
    exit();
}
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


        <div class="search-sort-container">
            <div class="filter-dropdown">
                <select id="status-filter">
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>

            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search products..." />
                <button id="search-btn"> <span class="material-icons-outlined">search</span></button>
            </div>            
        </div>

            <table id="products">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Buyer's Name</th>
                        <th>Address</th>
                        <th>Shipping</th>
                        <th>Freebie or Discount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

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
            $(document).ready(function () {
                loadPurchaseOrders();

                function loadPurchaseOrders() {
                    $.ajax({
                        url: '../serverFunctions.php',
                        type: 'POST',
                        data: { type: 'loadPurchaseOrders' },
                        success: function (response) {
                            const purchaseOrders = JSON.parse(response);
                            const table = $('#products');
                            const uniqueOrders = {};

                            const validStatuses = ['Pending', 'Ready For Pickup', 'Completed', 'Check Payment'];

                            purchaseOrders.forEach(function (purchaseOrder) {
                                if (validStatuses.includes(purchaseOrder.status)) {
                                    const key = `${purchaseOrder.transaction_id}_${purchaseOrder.user_id}`;

                                    if (!uniqueOrders[key]) {
                                        uniqueOrders[key] = true;
                                        const newRow = $('<tr></tr>');
                                        newRow.append($('<td></td>').text(purchaseOrder.transaction_id));
                                        newRow.append($('<td></td>').text(purchaseOrder.firstName + ' ' + purchaseOrder.lastName));
                                        newRow.append($('<td></td>').text(purchaseOrder.address));
                                        newRow.append($('<td></td>').text(purchaseOrder.shipping));
                                        newRow.append($('<td></td>').text(purchaseOrder.discount));
                                        newRow.append($('<td></td>').text(purchaseOrder.status));
                                        newRow.on('click', function () {
                                            window.location.href = 'adminPODetails.php?transaction_id=' + purchaseOrder.transaction_id;
                                        });
                                        table.append(newRow);
                                    }
                                }
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error('Error loading purchase orders:', error);
                        }
                    });
                }
            });
        </script>
        <script src="../test/sidebarToggle.js"></script>

</body>

</html>

<style>
     /* Container for search and sort */
  .search-sort-container {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 20px;
  }

  /* Search bar styling */
  .search-bar {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 25px;
    overflow: hidden;
    margin-right: 10px;
    margin-left: 10px;

  }

  #search-input {
    border: none;
    padding: 10px;
    outline: none;
    width: 200px;
  }

  #search-btn {
    background-color: hsl(93, 100%, 20%);
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
  }

/* Dropdown container */
.filter-dropdown {
    position: relative;
}

/* Styling the dropdown */
#status-filter {
    appearance: none; /* Removes default browser styling */
    background-color: #ffffff;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 14px;
    font-family: Arial, sans-serif;
    cursor: pointer;
    color: #333;
    transition: all 0.3s ease;
}

/* Adding a custom arrow */
#status-filter::after {
    content: '▼'; /* Custom arrow */
    font-size: 12px;
    color: #777;
    position: absolute;
    right: 10px;
    pointer-events: none;
}

/* Dropdown hover effects */
#status-filter:hover {
    border-color: #999;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* On focus */
#status-filter:focus {
    outline: none;
    border-color: #007BFF;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}
</style>