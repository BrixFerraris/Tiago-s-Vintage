<?php
include_once '../server/includes/sidebar.php';
?>

<!-- makikita lang to ng owner/super admins, 
 bale yung ibang admin di nila makikita yung admin profile sa sidebar
 -->




<main class="main-container">
    <div class="main-title">
        <p class="font-weight-bold">ADMIN PROFILE</p>
    </div>

    <div class="content">
        <div class="aa">
            <h1>Admin Profile</h1>
            <button class="add-btn" >Add Admin </button>
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
  <tr>
    <td>Juan Carlo</td>
    <td>
    <div class="form-group role-container">
            <select id="role" name="role" required>
                <option value="super_admin">Super Admin</option>
                <option value="add_product">Add Product</option>
                <option value="accept_order">Accept Orders</option>
                <option value="change_content">Change Contents</option>
            </select>
        </div>
    </td>
    <td><button class="delete-btn">Delete</button></td>
  </tr>
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
        
    }

    .save-btn, .cancel-btn {
        border: none;
        margin: 10px;
        padding: 8px 16px;
        font-size: 14px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
        color: #fff;
    }
    
    .save-btn {
        background-color: rgb(76, 175, 80);
    }

    .cancel-btn {
        background-color: rgb(244, 67, 54);
    }
    .form-group{
        width: 300px;
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