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
            <button class="add-btn">Add Admin</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Admin Name</th>
                    <th>Admin Permissions</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming the image data is in an array format (adjust as needed)
                $adminData = [
                    ['Admin Name' => 'Juan Carlo', 'Admin Permissions' => 'Stocks', 'Delete' => 'Delete'],
                    ['Admin Name' => 'Juan Carlo', 'Admin Permissions' => 'Orders', 'Delete' => 'Delete'],
                    ['Admin Name' => 'Juan Carlo', 'Admin Permissions' => 'Sorting', 'Delete' => 'Delete']
                ];

                foreach ($adminData as $admin) {
                    echo '<tr>';
                    echo '<td>' . $admin['Admin Name'] . '</td>';
                    echo '<td><select>';
                    echo '<option value="Stocks"'.($admin['Admin Permissions'] === 'Stocks' ? ' selected' : '').'>Stocks</option>';
                    echo '<option value="Orders"'.($admin['Admin Permissions'] === 'Orders' ? ' selected' : '').'>Orders</option>';
                    echo '<option value="Sorting"'.($admin['Admin Permissions'] === 'Sorting' ? ' selected' : '').'>Sorting</option>';
                    echo '</select></td>';
                    echo '<td><button class="delete-btn">Delete</button></td>';
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
        <div class="buttons">
            <button class="save-btn">Save</button>
            <button class="cancel-btn">Cancel</button>
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

    .buttons {
        display: flex;
        justify-content: flex-end;
        margin-top: 10px;
    }

    .save-btn, .cancel-btn {
        border: none;
        padding: 8px 16px;
        font-size: 14px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
        color: #fff;
    }

    .save-btn {
        background-color: #0057E1;
    }

    .cancel-btn {
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
</script>