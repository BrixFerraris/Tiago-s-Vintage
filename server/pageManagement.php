<?php
  include_once './includes/sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/pageManagement.css">
    <title>Page Management</title>
</head>
<body>
     <!-- Main -->
     <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">PAGE MANAGEMENT</p>
        </div>

        <div class="content">
            <h1>Page Management</h1>
            <table>
                <thead>
                    <tr>
                        <th>Page Title</th>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- Static Report Data -->
                        <td>Home</td>
                        <td>/home</td>
                        <td>Published</td>
                        <td><button class="edit-btn">Edit</button></td>
                        <td><button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>About Us</td>
                        <td>/about-us</td>
                        <td>Draft</td>
                        <td><button class="edit-btn">Edit</button></td>
                        <td><button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td>/contact</td>
                        <td>Published</td>
                        <td><button class="edit-btn">Edit</button></td>
                        <td><button class="delete-btn">Delete</button></td>
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
        </div>
    </div>
</body>
</html>
