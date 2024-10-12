<?php
  include_once './includes/sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/inventory.css">
    <title>Inventory</title>
</head>
<body>
    <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">INVENTORY</p>
        </div>

        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Accept</th>
                        <th>Delete</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nike</td>
                        <td>2</td>
                        <td>Blk 11 lot 25 Imus, Cavite</td>
                        <td>Pending</td>
                        <td><button class="accept-btn">Accept</button></td>
                        <td><button class="delete-btn">Delete</button></td>
                    </tr>
                    <!-- Add additional product rows here -->
                </tbody>
            </table>

            </table>
            <div class="pagination">
                <button class="page-btn">Previous</button>
                <button class="page-btn">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">Next</button>
            </div>
        </div>
    </div>
</body>
</html>
