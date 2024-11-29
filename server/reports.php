<?php
session_start();

if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    if ($role === 'Super Admin') {
        include_once './includes/sidebar.php';
    } elseif ($role === 'Add Product') {
        include_once './includes/sidebarAdd_Product.php';
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
    <link rel="stylesheet" href="../CSS/reports.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <title>Reports</title>
</head>

<body>
    <!-- Main -->
    <main class="main-container">
        <div class="main-title">
            <p class="font-weight-bold">REPORTS</p>
        </div>

        <div class="content">

            <div class="charts-container">
                <!-- Monthly Sales Chart -->
                <div class="chart">
                    <canvas id="monthlySalesChart"></canvas>
                </div>
                <!-- Yearly Sales Chart -->
                <div class="chart">
                    <canvas id="yearlySalesChart"></canvas>
                </div>
            </div>



            <div class="tables-container">
                <!-- Most Added to Cart Table -->
                <div class="table-section">
                    <h2>Top 5 Added to Cart Items</h2>
                    <table id="cart-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Added to Cart</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sample Item 1</td>
                                <td>150</td>
                            </tr>
                            <tr>
                                <td>Sample Item 2</td>
                                <td>120</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Top Selling Items Table -->
                <div class="table-section">
                    <h2>Top 5 Selling Items</h2>
                    <table id="sales-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Units Sold</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sample Item A</td>
                                <td>300</td>
                            </tr>
                            <tr>
                                <td>Sample Item B</td>
                                <td>280</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Low Stock Items Table -->
                <div class="table-section">
                    <h2>Low Stock Items</h2>
                    <table id="stock-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Stock Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sample Low Stock Item 1</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>Sample Low Stock Item 2</td>
                                <td>2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
</body>

<script>
    // Monthly Sales Chart
    const fetchMonthlySalesData = () => {
        $.ajax({
            type: 'GET',
            url: './includes/getMonthlySales.php',
            dataType: 'json',
            success: function (response) {
                const monthlySalesData = response.map(data => ({
                    month: data.month.split('-')[1],
                    sales: data.sales
                }));
                const labels = monthlySalesData.map(data => {
                    const monthIndex = parseInt(data.month, 10);
                    return new Date(0, monthIndex - 1).toLocaleString('default', { month: 'long' });
                });
                const salesData = monthlySalesData.map(data => data.sales);
                const ctxMonthly = document.getElementById('monthlySalesChart').getContext('2d');
                new Chart(ctxMonthly, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Monthly Sales',
                            data: salesData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ', status, error);
            }
        });
    };
    fetchMonthlySalesData()

    const fetchYearlySalesData = () => {
        $.ajax({
            type: 'GET',
            url: './includes/getYearlySales.php',
            dataType: 'json',
            success: function (response) {
                const yearlySalesData = response.map(data => ({
                    year: data.year,
                    sales: data.sales
                }));
                const labels = yearlySalesData.map(data => data.year);
                const salesData = yearlySalesData.map(data => data.sales);
                const ctxYearly = document.getElementById('yearlySalesChart').getContext('2d');
                new Chart(ctxYearly, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Yearly Sales',
                            data: salesData,
                            backgroundColor: 'rgba(153, 102, 255, 0.5)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ', status, error);
            }
        });
    };

    fetchYearlySalesData()
    const getTopProducts = () => {
        $.ajax({
            type: 'GET',
            url: './includes/getTopProducts.php',
            dataType: 'json',
            success: function (response) {
                const tbody = $('#sales-table tbody');
                tbody.empty();
                if (response.length === 0) {
                    tbody.append(`
                            <tr>
                                <td colspan="2" style="text-align:center; color:red;">No Product Sales Yet</td>
                            </tr>
                        `);
                } else {
                    response.forEach(product => {
                        tbody.append(`
                            <tr>
                                <td>${product.product_name}</td>
                                <td>${product.count}</td>
                            </tr>
                        `);
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ', status, error);
            }
        });
    };
    getTopProducts();

    const getTopCart = () => {
        $.ajax({
            type: 'GET',
            url: './includes/getTopCart.php',
            dataType: 'json',
            success: function (response) {
                const tbody = $('#cart-table tbody');
                tbody.empty();
                if (response.length === 0) {
                    tbody.append(`
                            <tr>
                                <td style="text-align:center; color:red;" colspan="2">No Product in Cart yet</td>
                            </tr>
                        `);
                } else {
                    response.forEach(product => {
                        tbody.append(`
                            <tr>
                                <td>${product.product_name}</td>
                                <td>${product.count}</td>
                            </tr>
                        `);
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ', status, error);
            }
        });
    };
    getTopCart();

    const getLowProducts = () => {
        $.ajax({
            type: 'GET',
            url: './includes/getLowProducts.php',
            dataType: 'json',
            success: function (response) {
                const tbody = $('#stock-table tbody');
                tbody.empty();
                if (response.length === 0) {
                    tbody.append(`
                            <tr>
                                <td colspan="2" style="text-align:center; color:red;">All Products are high on stocks</td>
                            </tr>
                        `);
                } else {
                    response.forEach(product => {
                        tbody.append(`
                            <tr>
                                <td>${product.variationName}</td>
                                <td>${product.quantity}</td>
                            </tr>
                        `);
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ', status, error);
            }
        });
    };
    getLowProducts();
</script>
<script src="../test/sidebarToggle.js"></script>

<style>

</style>

</html>