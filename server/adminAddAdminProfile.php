
<?php
  include_once './includes/sidebar.php';
?>



      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">Add Admin</p>
        </div>

    <!-- form add products -->
    <div class="form-container">
        <form action="./includes/uploadSingleProduct.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Name" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group role-container">
                <label for="role">Role</label>
                    <div class="role-entry">
                        <select id="role" name="role" required>

                            <option value="super_admin">Super Admin</option>
                            <option value="add_product">Add Product</option>
                            <option value="accept_order">Accept Orders</option>
                            <option value="change_content">Change Contents</option>

                        </select>
                    </div>
            
            <div class="btns">
                <button class="save" name="save" type="submit">Save</button>
                <button class="cancel" name="cancel" type="submit">Cancel</button>
            </div>
            

        </form>
    </div>
    </main>
    <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->

    <style>

        .btns button{
            margin-top: 20px;
        }

        .btns .save{
            background-color: rgb(76, 175, 80);
        }
        .btns .cancel{
            background-color: rgb(244, 67, 54);
        }
    </style>

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


//category
document.addEventListener('DOMContentLoaded', function () {

});

</script>
  </body>
</html>

