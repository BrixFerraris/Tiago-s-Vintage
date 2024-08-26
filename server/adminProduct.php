<?php

include_once './includes/sidebar.php';
?>


      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">PRODUCTS</p>
        </div>

        <div class="content">
            <h1>Products</h1>
            <table>
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Offer</th>
                        <th>Product Category</th>
                        <th>Product Color</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><img src="../images/white-shoes.jpg" alt="White Shoes"></td>
                        <td>White Shoes</td>
                        <td>$155.00</td>
                        <td>0%</td>
                        <td>shoes</td>
                        <td>white</td>
                        <td><button class="edit-btn">Edit</button></td>
                        <td><button class="delete-btn">Delete</button></td>
                    </tr>
                    <!-- Add additional product rows here -->
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

    <!-- Scripts -->
    <!-- Custom JS -->
    <script>

// SIDEBAR TOGGLE

let sidebarOpen = false;
const sidebar = document.getElementById('sidebar');

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}



    </script>
</body>
</html>