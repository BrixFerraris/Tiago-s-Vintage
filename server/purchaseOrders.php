<?php
session_start();

if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    if ($role === 'Super Admin') {
        include_once './includes/sidebar.php';
    } elseif ($role === 'Accept Orders') {
        include_once './includes/sidebarAccept_Order.php';
    } else {
        header("location: http://localhost/tiago/client/landing.php");
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
                        <option value="All">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Check Payment">Check Payment</option>
                        <option value="Completed">Completed</option>
                        <option value="Ready For Pickup">Ready For Pickup</option>
                        <option value="Out For Delivery">Out For Delivery</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Replace">Replace</option>
                    </select>
                </div>

                <div class="search-bar">
                    <input type="text" id="search-input" placeholder="Search Order" />
                    <button id="search-btn">Search</button>
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

            <!-- End Main -->
        </div>
        </div>
</body>

</html>
<script>
    $(document).ready(function () {
        loadPurchaseOrders();
        fetchPurchaseOrders("All");
        function loadPurchaseOrders() {
            $.ajax({
                url: '../serverFunctions.php',
                type: 'POST',
                data: { type: 'loadPurchaseOrders' },
                success: function (response) {
                    const purchaseOrders = JSON.parse(response);
                    const table = $('#products');
                    const uniqueOrders = {};
                    const validStatuses = ['Pending', 'Ready For Pickup', 'Completed', 'Check Payment', 'Out For Delivery'];
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
        function fetchPurchaseOrders(selectedStatus) {
            $.ajax({
                url: './includes/searchPO.php',
                type: 'GET',
                data: { status: selectedStatus },
                dataType: 'json',
                success: function (response) {
                    $('#products tbody').empty();
                    const uniqueOrders = {};
                    const validStatuses = ['Pending', 'Ready For Pickup', 'Completed', 'Check Payment', 'Out For Delivery', 'Cancelled', 'For Replacement'];
                    if (response.order_items.length > 0) {
                        response.order_items.forEach(function (purchaseOrder) {
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
                                    $('#products tbody').append(newRow);
                                }
                            }
                        });
                    } else {
                        $('#products tbody').append('<tr><td colspan="6">No results found for the selected status.</td></tr>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' ' + error);
                    $('#products tbody').append('<tr><td colspan="6">An error occurred while fetching data.</td></tr>');
                }
            });
        }
        $('#status-filter').change(function () {
            var selectedStatus = $(this).val();
            fetchPurchaseOrders(selectedStatus);
        });
        $(document).on('click', '#search-btn', function () {
            var searchQuery = $('#search-input').val();
            if (searchQuery) {
                $.ajax({
                    url: './includes/POsearch.php',
                    type: 'GET',
                    data: { query: searchQuery },
                    dataType: 'json',
                    success: function (response) {
                        $('#products tbody').empty();
                        if (response.length > 0) {
                            response.forEach(function (transaction) {
                                const newRow = $('<tr></tr>');
                                newRow.append($('<td></td>').text(transaction.transaction_id));
                                newRow.append($('<td></td>').text(transaction.firstName + ' ' + transaction.lastName));
                                newRow.append($('<td></td>').text(transaction.address));
                                newRow.append($('<td></td>').text(transaction.shipping));
                                newRow.append($('<td></td>').text(transaction.discount));
                                newRow.append($('<td></td>').text(transaction.status));
                                $('#products tbody').append(newRow);
                            });
                        } else {
                            $('#products tbody').append('<tr><td colspan="6">No results found.</td></tr>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error: ' + status + ' ' + error);
                        $('#products tbody').append('<tr><td colspan="6">An error occurred while fetching data.</td></tr>');
                    }
                });
            } else {
                $('#products tbody').empty();
            }
        });
    });
</script>
<script src="../test/sidebarToggle.js"></script>



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
        appearance: none;
        /* Removes default browser styling */
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
        content: '▼';
        /* Custom arrow */
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