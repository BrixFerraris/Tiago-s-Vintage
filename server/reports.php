<?php
  include_once './includes/sidebar.php';
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
                    <table>
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
                    <table>
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
                    <table>
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
        // Sample Data for Monthly and Yearly Sales Charts
        const monthlySalesData = [
            { month: 'January', sales: 1500 },
            { month: 'February', sales: 1700 },
            { month: 'March', sales: 1400 },
            { month: 'April', sales: 1600 },
            { month: 'May', sales: 1900 }
        ];

        const yearlySalesData = [
            { year: '2021', sales: 20000 },
            { year: '2022', sales: 25000 },
            { year: '2023', sales: 27000 }
        ];

        // Monthly Sales Chart
        const ctxMonthly = document.getElementById('monthlySalesChart').getContext('2d');
        new Chart(ctxMonthly, {
            type: 'line',
            data: {
                labels: monthlySalesData.map(data => data.month),
                datasets: [{
                    label: 'Monthly Sales',
                    data: monthlySalesData.map(data => data.sales),
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

        // Yearly Sales Chart
        const ctxYearly = document.getElementById('yearlySalesChart').getContext('2d');
        new Chart(ctxYearly, {
            type: 'bar',
            data: {
                labels: yearlySalesData.map(data => data.year),
                datasets: [{
                    label: 'Yearly Sales',
                    data: yearlySalesData.map(data => data.sales),
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
    </script>
    <style>
        
    </style>

</html>
