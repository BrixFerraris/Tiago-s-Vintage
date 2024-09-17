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
          <p class="font-weight-bold">Purchase Orders</p>
        </div>

        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Buyer's Name</th>
                        <th>Items</th>
                        <th>Quantity</th>
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
                        <td>Shoes</td>
                        <td>5</td>
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
</body>
</html>
