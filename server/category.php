<?php
  include_once './includes/sidebar.php';
?>

      <!-- Main -->
      <main id="container" class="main-container ">
        <div class="main-title">
          <p class="font-weight-bold">CATEGORY</p>
        </div>
        <div class="add-category">
        <button class="btnAddCat">Add Category</button>
        </div>

            <table id="products" >
                <thead>
                    <tr>
                        <th>Category Id</th>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Edit Category</th>
                        <th>Delete Category</th>
                    </tr>
                </thead>
                <tbody id="products-body" >
                    <tr>
                        <td>1</td>
                        <td><img src="../images/bg1.png" alt=""></td>
                        <td>All Products</td>
                        <td><button class="edit-btn" data-id="">Edit</button></td>
                        <td><button class="delete-btn" data-id="">Delete</button></td>
                    </tr>
                </tbody>
            </table>

            <div class="modal-edit">
                <div class="modals">
                    <form action="./includes/editCategory.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="category-id" name="id">
                    <h2>Edit Category</h2>
                    <img id="categoryImage" src="../images/bg1.png" alt="Category Image" width="20%" height="25%">
                    <input type="file" id="myFile" name="filename">
                    <p>Category Name:</p>
                    <input type="text" name="categoryName" id="categoryName" placeholder="All Product">
                    <div class="order-btn">
                        <button class="btnSubmit">Submit</button>
                        <button class="btnBack">Back</button>
                    </div>
                    </form>
                </div>
            </div>


<div class="modal-add">
        <div class="modals-addCat">
            <form action="./includes/addCategory.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
                <label for="title">Category Title</label>
                <input type="text" id="title" name="title" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="img1">Image</label>
                <input type="file" id="img1" name="img1" accept="image/*" required>
            </div>
            <div class="order-btn">
            <button class="btnaddSubmit">Submit</button>
            <button class="btnaddBack">Back</button>
        </div>
        </form>
        </div>
    </div>
</div>

<style>

    .add-category{
        display: flex;
        justify-content: flex-end;
        margin-bottom: 10px;
    }

    .modal-active1 {
    visibility: visible;
    opacity: 1;
}
    .modal-edit, .modal-add{
    position: fixed;
    width: 100%;
    height: 100vh;
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
.modals-addCat{
    background-color: white;
    width: 25%;
    height: 40%;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: column;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.modals{
    background-color: white;
    width: 40%;
    height: 60%;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: column;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}
.btnBack, .btnSubmit, .btnAddCat, .btnaddSubmit, .btnaddBack{
    padding: 10px 20px;
    background-color: green;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.btnaddBack, .btnBack{
    background-color: #e53935;

}
.btnAddCat, .btnaddSubmit, .btnSubmit{
    background-color: #28a745;

}

input[type="text"] {
    width: 50%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
}

</style>
    <script>


    $(document).ready(function() {
    var modalBtn = document.querySelector('.edit-btn');
    var modalBg = document.querySelector('.modal-edit');
    var modalClose = document.querySelector('.btnBack');
    var modalBtn1 = document.querySelector('.btnAddCat');
    var modalBg1 = document.querySelector('.modal-add');
    var modalClose1 = document.querySelector('.btnaddBack');
    
    modalBtn.addEventListener('click', function() {
        modalBg.classList.add('modal-active');
    });
    modalClose.addEventListener('click', function(){
        modalBg.classList.remove('modal-active');
    });

    modalBtn1.addEventListener('click', function() {
    });
    modalClose1.addEventListener('click', function(){
        modalBg1.classList.remove('modal-active');
    });
    function fetchCategories() {
        $.ajax({
            url: './includes/getCategories.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#products-body').empty();
                console.log(data);
                $.each(data, function(index, category) {
                    $('#products-body').append(`
                        <tr>
                            <td>${category.id}</td>
                            <td><img src="./includes/uploads/${category.image}" alt="${category.category}" style="width: 50px; height: auto;"></td>
                            <td>${category.category}</td>
                            <td><button class="edit-btn" data-id="${category.id}">Edit</button></td>
                            <td><button class="delete-btn" data-id="${category.id}">Delete</button></td>
                        </tr>
                    `);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching categories: ", textStatus, errorThrown);
            }
        });
    }
    $(document).on('click', '.delete-btn', function() {
        
        const id = $(this).data('id');
        if (confirm("Are you sure you want to delete this category?")) {
            $.ajax({
                url: './includes/deleteCategory.php',
                method: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error deleting category: ", textStatus, errorThrown);
                }
            });
        }
    });
    $(document).on('click', '.edit-btn', function() {
        modalBg.classList.add('modal-active');
        const categoryId = $(this).data('id'); 
        console.log(categoryId);
        $.ajax({
            url: './includes/getCategories.php', 
            method: 'GET',
            data: { id: categoryId }, 
            dataType: 'json',
            success: function(data) {
                if (data) {
                    $('#categoryImage').attr('src', `../server/includes/uploads/${data.image}`);
                    $('#category-id').val(data.id);
                    $('#categoryName').val(data.category);
                    modalBg.classList.add('modal-active');
                } else {
                    alert('Category not found.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching category details: ", textStatus, errorThrown);
            }
        });
    });

    fetchCategories();
});
    </script>

</body>
</html>
