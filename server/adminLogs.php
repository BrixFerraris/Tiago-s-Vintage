<?php
session_start();

if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    if ($role === 'Super Admin') {
        include_once './includes/sidebar.php';
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
    <link rel="stylesheet" href="./adminLogs.css">
    <title>AdminLogs</title>
</head>

<body>
    <main class="main-container">
        <div class="main-title">
            <p class="font-weight-bold">ADMIN LOGS</p>
        </div>

        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Admin Name</th>
                        <th>Location</th>
                        <th>Changes</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Admin 1</td>
                        <td>Purchase Orders</td>
                        <td>Accepted Order</td>
                        <td>#1123</td>
                    </tr>
                    <tr>
                        <td>Super Admin 2</td>
                        <td>Category</td>
                        <td>Added a Category</td>
                        <td>Shoes</td>
                    </tr>
                    <tr>
                        <td>Admin 3</td>
                        <td>Products</td>
                        <td>Added a Product</td>
                        <td>Nike T-Shirt</td>
                    </tr>
                    <tr>
                        <td>Admin 4</td>
                        <td>Products</td>
                        <td>Added a Variation</td>
                        <td>Nike T-Shirt</td>
                    </tr>

                </tbody>
            </table>

            <div class="pagination">
                <a href="#" class="prev">Previous</a>
                <a href="#" class="page-num">1</a>
                <a href="#" class="page-num">2</a>
                <a href="#" class="next">Next</a>
            </div>



        </div>
        </div>
</body>

</html>

<script src="../test/sidebarToggle.js"></script>
