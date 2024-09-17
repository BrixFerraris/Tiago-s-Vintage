<?php
  include_once './includes/sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/reports.css">
    <title>Reports</title>
</head>
<body>
        <!-- Main -->
        <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">REPORTS</p>
        </div>

        <div class="content">
            <h1>Reports</h1>
            <table>
                <thead>
                    <tr>
                        <th>Report Name</th>
                        <th>Type</th>
                        <th>Date Generated</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- Static Report Data -->
                        <td>Sales Report - August 2024</td>
                        <td>Sales</td>
                        <td>2024-09-01</td>
                        <td>Complete</td>
                    </tr>
                    <tr>
                        <td>Inventory Report - Sept 2024</td>
                        <td>Inventory</td>
                        <td>2024-09-01</td>
                        <td>In Progress</td>
                    </tr>
                    <tr>
                        <td>Customer Feedback - July 2024</td>
                        <td>Customer</td>
                        <td>2024-09-05</td>
                        <td>Complete</td>
                    </tr>
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

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
