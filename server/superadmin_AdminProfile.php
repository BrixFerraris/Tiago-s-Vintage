<?php
session_start();
if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
  if ($role === 'Super Admin') {
    include_once './includes/sidebar.php';
  } else {
    include_once './includes/sidebar.php';
  }
} else {
  header("location: ../landing.php?error=NotLoggedIn");
  exit();
}
?>

<main class="main-container">
  <div class="main-title">
    <p class="font-weight-bold">ADMIN PROFILE</p>
  </div>
  <div class="content">
    <div class="aa">
      <button class="add-btn">Add Admin </button>
    </div>
    <table id="admin-table">
      <thead>
        <tr>
          <th>Admin Name</th>
          <th>Admin Permissions</th>
          <th>Username</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

</main>

<!-- Modal add admin -->
<div class="modal-add-admin">
  <div class="modals">
    <form action="../client/includes/register.php" method="post">
      <h1>Add Admin</h1>
      <div class="inputs">
        <div class="form-group">
          <label for="adminName">First Name</label>
          <input type="text" id="adminName" name="firstName" placeholder="Enter admin first name" required>
        </div>
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" id="lastName" name="lastName" placeholder="Enter admin last name" required>
        </div>
        <div class="form-group">
          <label for="adminRole">Admin Role</label>
          <select id="adminRole" name="adminRole">
            <option value="Super Admin">Super Admin</option>
            <option value="Add Product">Add Product</option>
            <option value="Accept Orders">Accept Orders</option>
            <option value="Change Contents">Change Contents</option>
          </select>
        </div>

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter username" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter password" required>
        </div>
      </div>
      <div class="btns">
        <button name="admin" type="submit" class="btnSave">Save</button>
        <button type="button" class="btnCancel">Cancel</button>
      </div>
    </form>
  </div>
</div>
<!-- Modal edit -->
<div class="modal-edit">
  <div class="modals">
    <form action="./includes/editAdmin.php" method="post" enctype="">
      <h1>Edit Admin</h1>
      <input type="hidden" id="adminId" name="adminId" value="">
      <div class="inputs">
        <div class="form-group">
          <label for="fName">Admin First Name</label>
          <input type="text" id="fName" name="fName" placeholder="Enter First name" required>
        </div>
        <div class="form-group">
          <label for="lName">Admin Last Name</label>
          <input type="text" id="lName" name="lName" placeholder="Enter Last name" required>
        </div>
        <div class="form-group">
          <label for="role">Admin Role</label>
          <select id="role" name="role">
            <option value="Super Admin">Super Admin</option>
            <option value="Add Product">Add Product</option>
            <option value="Accept Orders">Accept Orders</option>
            <option value="Change Contents">Change Contents</option>
          </select>
        </div>

        <div class="form-group">
          <label for="uName">Username</label>
          <input type="text" id="uName" name="uName" placeholder="Enter username" required>
        </div>

        <div class="form-group">
          <label for="pWord">Password</label>
          <input type="password" id="pWord" name="pWord" placeholder="Enter password">
        </div>
      </div>
      <div class="btns">
        <button type="submit" class="btnSave">Save</button>
        <button type="button" class="btnCancel">Cancel</button>
      </div>
    </form>
  </div>
</div>
<script>
  $(document).ready(function () {
    $('.add-btn').on('click', function () {
      $('.modal-add-admin').addClass('modal-active');
    });

    $('.modal-add-admin .btnCancel').on('click', function () {
      $('.modal-add-admin').removeClass('modal-active');
    });

    $('.modal-edit .btnCancel').on('click', function () {
      $('.modal-edit').removeClass('modal-active');
    });

    let sidebarOpen = false;
    const sidebar = $('#sidebar');

    function openSidebar() {
      if (!sidebarOpen) {
        sidebar.addClass('sidebar-responsive');
        sidebarOpen = true;
      }
    }

    function closeSidebar() {
      if (sidebarOpen) {
        sidebar.removeClass('sidebar-responsive');
        sidebarOpen = false;
      }
    }

    $('.sidebar-toggle-btn').on('click', function () {
      if (sidebarOpen) {
        closeSidebar();
      } else {
        openSidebar();
      }
    });
    $.ajax({
      url: './includes/getAdmins.php',
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        let rows = '';
        $.each(data, function (index, admin) {
          rows += '<tr>';
          rows += '<td>' + admin.firstName + " " + admin.lastName + '</td>';
          rows += '<td>' + admin.role + '</td>';
          rows += '<td>' + admin.username + '</td>';
          rows += '<td>' +
            '<button class="edit-btn" data-id="' + admin.id + '">Edit</button>' +
            '<button class="delete-btn" data-id="' + admin.id + '">Delete</button>' +
            '</td>';
          rows += '</tr>';
        });
        $('#admin-table tbody').html(rows);
        $('#admin-table').on('click', '.edit-btn', function () {
          var adminId = $(this).data('id');
          $('.modal-edit').addClass('modal-active');
          $.ajax({
            url: './includes/showEditAdmin.php',
            type: 'POST',
            data: { id: adminId },
            dataType: 'json',
            success: function (response) {
              if (response.error) {
                alert(response.error);
              } else {
                $('#fName').val(response.firstName);
                $('#lName').val(response.lastName);
                $('#role').val(response.role);
                $('#uName').val(response.username);
                $('#adminId').val(response.id);
              }
            },
            error: function (xhr, status, error) {
              console.error('AJAX Error: ' + status + error);
            }
          });
        });
        $(document).on('click', '.delete-btn', function () {
          var userId = $(this).data('id');
          if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
              url: './includes/deleteUser.php',
              type: 'POST',
              data: { id: userId },
              success: function (response) {
                alert('User deleted successfully');
                location.reload();
              },
              error: function (xhr, status, error) {
                alert('An error occurred: ' + error);
              }
            });
          }
        });
      },
      error: function (xhr, status, error) {
        console.error('AJAX Error: ' + status + error);
      }
    });
  });
</script>

<style>
  .aa {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top,
    margin-bottom: 30px;
    margin-left: auto;
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
    margin-top,
    margin-bottom: 30px;
    margin-left: auto;
  }

  .buttons {
    display: flex;
    justify-content: flex-end;

  }

  .save-btn,
  .cancel-btn {
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

  .form-group {
    width: 300px;
  }


  /*modal*/
  .modal-add-admin,
  .modal-edit {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    visibility: hidden;
    opacity: 0;
    transition: visibility 0s, opacity 0.3s ease-in-out;
  }

  .modal-active {
    visibility: visible;
    opacity: 1;
  }

  .modals {
    background-color: white;
    width: 50%;
    height: 70%;
    display: flex;
    flex-direction: column;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  }

  .btnSave,
  .btnCancel,
  button[type="submit"] .btnSave {
    padding: 15px 50px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: white;
  }

  .inputs {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 10%;
    margin-bottom: 10%;


  }

  .btns {
    justify-content: space-evenly;
    display: flex;
    margin-top: auto;
  }

  .btnCancel {
    background-color: #f44336;
  }

  .btnSave {
    background-color: #4CAF50;
  }

  .form-group input[type="text"],
  .form-group input[type="password"],
  .form-group textarea,
  .form-group select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
  }

  .modals h1 {
    text-align: center;
  }
</style>