<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Tiago's Vintage</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="icon" href="../assets/icons.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../CSS/addproduct.css">
    <link rel="stylesheet" href="../CSS/admindashboard.css">
    <link rel="stylesheet" href="../CSS/adminProduct.css">
  </head>
  <body>
    <div class="grid-container">

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">store</span> Tiago's Vintage
          </div>
        </div>

        <ul class="sidebar-list">
            <a href="./adminDashboard.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">dashboard</span> Dashboard
                    
                </li>
            </a>
            <a href="./product.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">inventory_2</span> Products
                </li>
            </a>

            <a href="./addProduct.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">add</span> Add Product
                </li>
            </a>

            <a href="./reports.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">poll</span> Reports
                </li>
            </a>

            <a href="./category.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">category</span> Category
                </li>
            </a>

            <a href="./adminLogin.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">logout</span> Logout
                </li>
            </a>

        </ul>
      </aside>
      <!-- End Sidebar -->