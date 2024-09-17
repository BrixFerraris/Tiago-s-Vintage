<?php
include_once '../server/includes/sidebar.php';
?>

<main class="main-container">
    <div class="main-title">
        <p class="font-weight-bold">ADMIN PROFILE</p>
    </div>

    <div class="content">
        <div class="aa">
            <h1>Admin Profile</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Admin Name</th>
                    <th>Admin Permissions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming the image data is in an array format (adjust as needed)
                $adminData = [
                    ['Admin Name' => 'Juan Carlo', 'Admin Permissions' => 'Stocks'],
                    ['Admin Name' => 'Juan Carlo', 'Admin Permissions' => 'Orders'],
                    ['Admin Name' => 'Juan Carlo', 'Admin Permissions' => 'Sorting']
                ];

                foreach ($adminData as $admin) {
                    echo '<tr>';
                    echo '<td>' . $admin['Admin Name'] . '</td>';
                    echo '<td>' . $admin['Admin Permissions'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <a href="#" class="prev">Previous</a>
            <a href="#" class="page-num">1</a>
            <a href="#" class="page-num">2</a>
            <a href="#" class="page-num">...</a>
            <a href="#" class="next">Next</a>
        </div>
    </main>
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