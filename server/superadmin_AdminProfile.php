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
            <button class="add-btn" >Add Admin </button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Admin Name</th>
                    <th>Admin Permissions</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
<tbody>
  <tr>
    <td>Juan Carlo</td>
    <td>Super Admin</td>
    <td>admin1</td>
    <td>
      <button class="edit-btn">Edit</button>
      <button class="delete-btn">Delete</button>
  </td>
  </tr>
</tbody>

        </table>
    </main>

        <!-- Modal add admin -->
        <div class="modal-add-admin">
        <div class="modals">
        <form action="" method="post" enctype="">
          <h1>Add Admin</h1>

        <div class="inputs">
          <div class="form-group">
                          <label for="adminName">Admin Name</label>
                          <input type="text" id="adminName" name="adminName" placeholder="Enter admin name" required>
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
                  <button type="submit" class="btnSave">Save</button>
                  <button type="button" class="btnCancel">Cancel</button>
                </div>
        </form>
          </div>
        </div>




        <!-- Modal edit -->
        <div class="modal-edit">
        <div class="modals">
        <form action="" method="post" enctype="">
          <h1>Edit Admin</h1>

        <div class="inputs">
          <div class="form-group">
                          <label for="adminName">Admin Name</label>
                          <input type="text" id="adminName" name="adminName" placeholder="Enter admin name" required>
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
                  <button type="submit" class="btnSave">Save</button>
                  <button type="button" class="btnCancel">Cancel</button>
                </div>
        </form>
          </div>
        </div>
        

<style>
          .aa {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top, margin-bottom: 30px;
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
    margin-top, margin-bottom: 30px;
    margin-left: auto;
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
.modals{
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
.btnCancel{
    background-color: #f44336;
}
.btnSave{
    background-color: #4CAF50;
}
.form-group input[type="text"], .form-group input[type="password"], .form-group textarea, .form-group select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
}

.modals h1{
  text-align: center;
}
</style>
<script>

//add admin modal
var modalBtn1 = document.querySelector('.add-btn');
var modalBg1 = document.querySelector('.modal-add-admin');
var modalClose1 = modalBg1.querySelector('.btnCancel');

modalBtn1.addEventListener('click', function() {
    modalBg1.classList.add('modal-active');
});
modalClose1.addEventListener('click', function(){
    modalBg1.classList.remove('modal-active');
});

//edit modal
var modalBtn2 = document.querySelector('.edit-btn');
var modalBg2 = document.querySelector('.modal-edit');
var modalClose2 = modalBg2.querySelector('.btnCancel');

modalBtn2.addEventListener('click', function() {
    modalBg2.classList.add('modal-active');
});
modalClose2.addEventListener('click', function(){
    modalBg2.classList.remove('modal-active');
});

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