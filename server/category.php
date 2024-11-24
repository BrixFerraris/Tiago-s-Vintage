<?php
session_start();

if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    if ($role === 'Super Admin') {
        include_once './includes/sidebar.php';
    } elseif ($role === 'Add Product') {
        include_once './includes/sidebarAdd_Product.php';
    } elseif ($role === 'Accept Orders') {
        include_once './includes/sidebarAccept_Order.php';
    } else {
        header("location: adminDashboard.php");
        exit();
    }
} else {
    header("location: ../landing.php?error=NotLoggedIn");
    exit();
}
?>

<!-- Main -->
<main id="container" class="main-container ">
    <div class="main-title">
        <p class="font-weight-bold">CATEGORY</p>
    </div>
    <div class="add-category">
        <button class="add-btn btnAddCat">Add Category</button>
    </div>

    <table id="products">
        <thead>
            <tr>
                <th>Category Id</th>
                <th>Image</th>
                <th>Category Name</th>
                <th>Edit Category</th>
                <th>Delete Category</th>
            </tr>
        </thead>
        <tbody id="products-body">
            <tr>
                <td>1</td>
                <td><img src="../images/bg1.png" alt=""></td>
                <td>All Products</td>
                <td><button class="edit-btn" data-id="">Edit</button></td>
                <td><button class="delete-btn" data-id="">Delete</button></td>
            </tr>
        </tbody>
    </table>
    
    
    <form action="./includes/editCategory.php" method="post" enctype="multipart/form-data">
    <div class="modal-edit">
        

            <div class="modals">
                <div>
                <input type="hidden" id="category-id" name="id">
                <h2>Edit Category</h2>
                </div>
                <div>
                <img id="categoryImage" src="../images/bg1.png" alt="Category Image" width="200px" height="200px"></div>
                <div class="file-category">
                <input type="file" id="myFile" name="filename"></div>
                <div>
                <p>Category Name:</p></div>
                <div class="input-category"><input type="text" name="categoryName" id="categoryName" placeholder="All Product"></div>
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
        .order-btn{
            margin-top: 10px;
        }
        .input-category, .file-category{
            align-items: center;
        }
        .add-category {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        /* General Modal Styling (unchanged) */
.modal-edit,
.modal-add {
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

.modals-addCat,
.modals {
    background-color: white;
    width: 30%;
    height: auto;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: column;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

/* Buttons */
.btnBack,
.btnSubmit,
.btnAddCat,
.btnaddSubmit,
.btnaddBack {
    padding: 10px 20px;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btnaddBack,
.btnBack {
    background-color: #e53935;
}

.btnAddCat,
.btnaddSubmit,
.btnSubmit {
    background-color: #28a745;
}

/* Input Fields */
input[type="text"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
}

/* Media Query for Tablets */
@media (max-width: 768px) {
    .modals-addCat,
    .modals {
        width: 80%; /* Adjust modal width */
        padding: 15px;
    }

    input[type="text"] {
        width: 100%; /* Adjust input width */
    }

    .btnBack,
    .btnSubmit,
    .btnAddCat,
    .btnaddSubmit,
    .btnaddBack {
        padding: 8px 16px; /* Adjust button size */
        font-size: 14px;
    }

    .input-category{
        margin: auto;
        display: inline;
    }
    .order-btn{
        display: flex;
        justify-content: space-evenly;
    }
}

/* Media Query for Mobile Devices */
@media (max-width: 480px) {
    .modals-addCat,
    .modals {
        width: 95%; /* Maximize modal width */
        padding: 10px;
    }

    input[type="text"] {
        width: 100%; /* Full width for inputs */
    }

    .btnBack,
    .btnSubmit,
    .btnAddCat,
    .btnaddSubmit,
    .btnaddBack {
        padding: 6px 12px; /* Smaller button padding */
        font-size: 12px;
    }

    img#categoryImage {
        width: 150px; /* Reduce image size */
        height: auto;
    }

    .input-category{
        margin: auto;
    }
}
    </style>
    <script>


        $(document).ready(function () {
            var modalBtn = document.querySelector('.edit-btn');
            var modalBg = document.querySelector('.modal-edit');
            var modalClose = document.querySelector('.btnBack');
            var modalBtn1 = document.querySelector('.btnAddCat');
            var modalBg1 = document.querySelector('.modal-add');
            var modalClose1 = document.querySelector('.btnaddBack');

            modalBtn.addEventListener('click', function () {
                modalBg.classList.add('modal-active');
            });
            modalClose.addEventListener('click', function () {
                modalBg.classList.remove('modal-active');
            });

            modalBtn1.addEventListener('click', function () {
            });
            modalClose1.addEventListener('click', function () {
                modalBg1.classList.remove('modal-active');
            });
            function fetchCategories() {
                $.ajax({
                    url: './includes/getCategories.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#products-body').empty();
                        console.log(data);
                        $.each(data, function (index, category) {
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
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Error fetching categories: ", textStatus, errorThrown);
                    }
                });
            }
            $(document).on('click', '.delete-btn', function () {
                const id = $(this).data('id');
                if (confirm("Are you sure you want to delete this category?")) {
                    $.ajax({
                        url: './includes/deleteCategory.php',
                        method: 'POST',
                        data: { id: id },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                alert(response.message);
                                location.reload();
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error("Error deleting category: ", textStatus, errorThrown);
                        }
                    });
                }
            });
            $(document).on('click', '.edit-btn', function () {
                modalBg.classList.add('modal-active');
                const categoryId = $(this).data('id');
                console.log(categoryId);
                $.ajax({
                    url: './includes/getCategories.php',
                    method: 'GET',
                    data: { id: categoryId },
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            $('#categoryImage').attr('src', `../server/includes/uploads/${data.image}`);
                            $('#category-id').val(data.id);
                            $('#categoryName').val(data.category);
                            modalBg.classList.add('modal-active');
                        } else {
                            alert('Category not found.');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Error fetching category details: ", textStatus, errorThrown);
                    }
                });
            });
            $(document).on('click', '.add-btn', function () {
                modalBg1.classList.add('modal-active');
            });

            fetchCategories();
        });
    </script>
            <script src="../test/sidebarToggle.js"></script>


    </body>

    </html>