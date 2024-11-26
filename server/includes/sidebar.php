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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../CSS/addproduct.css">
    <link rel="stylesheet" href="../CSS/admindashboard.css">
    <link rel="stylesheet" href="../CSS/adminProduct.css">
    <link rel="stylesheet" href="../CSS/sidebarResponsive.css">
  </head>
  <body>
    
    <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
          
    </div>

    
    


    <div class="grid-container">

      <!-- Sidebar -->
      <aside id="sidebar" class="sidebar-hidden">
        <div class="hide">
            <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>
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

            <a href="./superadmin_AdminProfile.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">group</span> Admin profile
                </li>
            </a>

            <a href="./purchaseOrders.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">add_shopping_cart</span> Purchase Orders
                </li>
            </a>

            <a href="./adminCustomerAccs.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">groups</span> Customers Account
                </li>
            </a>

            <a href="./reports.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">poll</span> Reports
                </li>
            </a>

            <a href="./pageManagement.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">web</span> Page management
                </li>
            </a>

            <a href="./adminReviews.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">rate_review</span> Reviews
                </li>
            </a>

            <a href="./category.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">category</span> Category
                </li>
            </a>

            <a href="http://localhost/tiago/client/includes/logout.php">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">logout</span> Logout
                </li>
            </a>

            

        </ul>
      </aside>
      <!-- End Sidebar -->

      <script>


</script>

      </script>