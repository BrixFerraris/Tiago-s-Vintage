<?php
session_start();
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    if ($role === 'Super Admin') {
        include_once './includes/sidebar.php';
    } elseif ($role === 'Accept Orders') {
        include_once './includes/sidebarAccept_Order.php';
    } elseif ($role === 'Change Contents') {
        include_once './includes/sidebarChange_Contents.php';
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
            <p class="font-weight-bold">CUSTOMER ACCOUNT</p>
        </div>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>E-mail</th>
                        <th>Orders Completed</th>
                    </tr>
                </thead>
                <tbody id="points-data">
                    <tr>
                        <td>1</td>
                        <td>clarence@gmail.com</td>
                        <td>6</td>
                        <td>6</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>clarence@gmail.com</td>
                        <td>13</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>clarence@gmail.com</td>
                        <td>24</td>
                        <td>14</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>clarence@gmail.com</td>
                        <td>13</td>
                        <td>13</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>clarence@gmail.com</td>
                        <td>69</td>
                        <td>69</td>
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
        <script>
            $(document).ready(function () {
                $.ajax({
                    url: './includes/getCustomerPoints.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        let rows = '';
                        data.forEach(function (item) {
                            rows += '<tr>';
                            rows += '<td>' + item.id + '</td>';
                            rows += '<td>' + item.username + '</td>';
                            rows += '<td>' + item.orders_completed + '</td>';
                            rows += '</tr>';
                        });
                        $('#points-data').html(rows);
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error: ' + status + error);
                    }
                });

            });
        </script>
        <script src="../test/sidebarToggle.js"></script>

</body>

</html>