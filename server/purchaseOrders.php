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
    header("location: ../landing.php?error=NotLoggedIn");
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
            <table id="products">
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
                // Load purchase orders when the document is ready
                loadPurchaseOrders();

                function loadPurchaseOrders() {
                    $.ajax({
                        url: '../serverFunctions.php',
                        type: 'POST',
                        data: { type: 'loadPurchaseOrders' },
                        success: function (response) {
                            const purchaseOrders = JSON.parse(response);
                            const table = $('#products'); 
                            table.empty();
                            purchaseOrders.forEach(function (purchaseOrder) {
                                const newRow = $('<tr></tr>');
                                newRow.append($('<td></td>').text(purchaseOrder.transaction_id));
                                newRow.append($('<td></td>').text(purchaseOrder.firstName + ' ' + purchaseOrder.lastName));
                                newRow.append($('<td></td>').text(purchaseOrder.address));
                                newRow.append($('<td></td>').text(purchaseOrder.status));
                                newRow.append($('<td></td>').html('<button class="accept-btn">Accept</button>'));
                                newRow.append($('<td></td>').html('<button class="delete-btn">Delete</button>'));

                                newRow.on('click', function () {
                                    window.location.href = 'adminPODetails.php?transaction_id=' + purchaseOrder.transaction_id;
                                });

                                table.append(newRow);
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