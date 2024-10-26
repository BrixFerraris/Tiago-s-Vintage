<?php
  include_once './includes/sidebar.php';
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
                    <th>ID</th>
                    <th>Username</th>
                    <th>Orders Completed</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Clar</td>
                    <td>6</td>
                    <td>6</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Duk</td>
                    <td>13</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Brix</td>
                    <td>24</td>
                    <td>14</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Alex</td>
                    <td>13</td>
                    <td>13</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Amiel</td>
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
</body>
</html>
