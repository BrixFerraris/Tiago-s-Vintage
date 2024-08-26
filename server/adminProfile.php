<?php
  include_once './includes/sidebar.php';
?>

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
        <p class="font-weight-bold">ADMIN PROFILE</p>
        </div>

        <div class="content">
            <div class="aa">
            <h1>Admin Profile</h1>
            <button class="add-btn">Add Admin</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Admin Name</th>
                        <th>Admin Permissions</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Owner</td>
                        <td>All</td>
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
                <a href="#" class="page-num">...</a>
                <a href="#" class="next">Next</a>
            </div>
      <!-- End Main -->
<style>
  .aa {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .add-btn {
    border: none;
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s;
    color: #fff;
    background-color: #0057E1;
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
</script>