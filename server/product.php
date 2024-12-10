<?php
session_start();

if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
  if ($role === 'Super Admin') {
    include_once './includes/sidebar.php';
  } elseif ($role === 'Add Product') {
    include_once './includes/sidebarAdd_Product.php';
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
    <p class="font-weight-bold">PRODUCTS</p>

  </div>

  <div class="content">
    <!-- input code here -->
    <!-- Search and Sort Container -->
    <div class="search-sort-container">
      <div class="search-bar">
        <input type="text" id="search-input" placeholder="Search products..." />
        <button id="search-btn"> <span class="material-icons-outlined">search</span></button>
      </div>

    </div>

    <table id="products">
      <thead>
        <tr>
          <th>Product Id</th>
          <th>Product Image</th>
          <th>Product Name</th>
          <th>Product Price</th>
          <th>Product Category</th>
          <th>Edit Product</th>
          <th>Delete Product</th>
        </tr>
      </thead>
      <tbody id="products-body">

      </tbody>
    </table>
  </div>
</main>

<!-- edit Main -->
<main id="edit-container" class="is-invisible main-container">
  <div class="main-title">
    <p class="font-weight-bold">Edit Products</p>
    <p id="edit-id"></p>
  </div>

  <!-- edit products -->


  <div class="edit-product">
    <div class="edit-product-left">
      <form action="./includes/addVariation.php" method="post">
        <input type="text" name="product_id" id="product-id">
        <p class="font-weight-bold">Variations:</p>
        <div class="edit-product-variations">

          <div id="variations">

          </div>
          <div class="edit-product-variation">
            <label for="Name">Name:</label>
            <input type="text" id="Name" name="Name" placeholder="Name" required>
          </div>

          <div class="edit-product-variation">
            <label for="width">Width:</label>
            <input id="width" type="number" name="width" placeholder="Width" required>
          </div>

          <div class="edit-product-variation">
            <label for="length">Length:</label>
            <input id="length" type="number" name="length" placeholder="Length" required>
          </div>

          <div class="edit-product-variation">
            <label for="quantity">Quantity:</label>
            <div class="quantity-control">
              <input type="number" id="qty" name="qty" placeholder="Quantity" required>
            </div>
          </div>
        </div>
    </div>

    <div class="edit-product-right">

      <div class="edit-product-title">
        <p class="font-weight-bold">Product Title</p>
        <input type="text" id="title" placeholder="Product Title">
        <i class="fas fa-edit edit-icon"></i>
      </div>

      <div class="edit-product-price">
        <p class="font-weight-bold">Price</p>
        <input type="text" id="price" placeholder="Price">
        <i class="fas fa-edit edit-icon"></i>
      </div>

      <div class="edit-product-category">
        <p class="font-weight-bold">Category</p>
        <select name="categories" id="categories">
          <option>Select Main Category</option>
        </select>
        <select name="sub_category" id="sub_category">
          <option>Select Sub Category</option>
        </select>

        <i class="fas fa-edit edit-icon"></i>
      </div>

      <button class="save-button">Save</button>
      <button class="discard-button">Discard</button>

    </div>

  </div>
  <div class="add-variation-btn">
    <input type="submit" name="add" value="Add Variation" class="add-variation"></input>
  </div>
  </form>
</main>
<!-- End EDIT -->
<!-- Scripts -->

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

  document.getElementById('search-input').addEventListener('input', function () {
    var searchValue = this.value;
    fetchProducts(searchValue);
  });

  function fetchProducts(searchValue = '') {
    $.ajax({
      url: '../serverFunctions.php',
      type: 'POST',
      data: { type: 'searchProducts', title: searchValue },
      success: function (response) {
        const data = JSON.parse(response);
        if (data.type === 'searchResults') {
          displayProducts(data.products);
        }
      },
      error: function (xhr, status, error) {
        console.error('Error fetching products:', error);
      }
    });
  }

  function displayProducts(products) {
    var table = document.getElementById('products').getElementsByTagName('tbody')[0];
    table.innerHTML = '';
    products.forEach(product => {
      var newRow = table.insertRow();
      var id = product.id;
      newRow.insertCell(0).setAttribute("product-id", id);
      newRow.insertCell(0).innerText = id;
      newRow.insertCell(1).innerHTML = '<img src="./includes/uploads/' + product.img1 + '" alt="Product Image">';
      newRow.insertCell(2).innerText = product.title;
      newRow.insertCell(3).innerText = '₱'+product.unit_price;
      newRow.insertCell(4).innerText = product.category;
      newRow.insertCell(5).innerHTML = '<button class="edit-btn" data-id="' + product.id + '">Edit</button>';
      newRow.insertCell(6).innerHTML = '<button class="delete-btn" data-id="' + product.id + '">Delete</button>';
    });
  }

  $(document).ready(function () {
    fetchProducts();
    $(document).on('click', '.delete-btn', function () {
      var id = $(this).data('id');
      if (confirm('Are you sure you want to delete this product?')) {
        $.ajax({
          url: '../serverFunctions.php',
          type: 'POST',
          data: { type: 'deleteProduct', id: id },
          success: function (response) {
            const data = JSON.parse(response);
            if (data.type === 'productDeleted') {
              alert('Product deleted successfully');
              fetchProducts();
            } else {
              alert('Error deleting product');
            }
          },
          error: function (xhr, status, error) {
            console.error('Error deleting product:', error);
          }
        });
      }
    });
    $(document).on('click', '.edit-btn', function () {
      var id = $(this).data('id');
      window.location.href = "adminEditProduct.php?product_id=" + id;
    });
  });





</script>
</body>

</html>
<style>
  .is-invisible {
    display: none;
  }


  .container {
    display: flex;
    width: 100%;
    height: 100vh;
    background-color: #f5f5f5;
  }


  /* Main Container */
  .main-container {
    flex: 1;
    padding: 20px;
  }

  .main-title {
    display: flex;
    justify-content: space-between;
  }

  .main-title>p {
    font-size: 20px;
  }

  /* Edit Product */
  .edit-product {
    display: flex;
    gap: 20px;
  }

  .edit-product-left {
    width: 50%;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
  }

  .edit-product-right {
    width: 50%;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
  }

  .edit-product-images {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
  }

  .edit-product-images img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
  }

  .edit-product-variations {
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
  }

  .edit-product-variation {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
  }

  .edit-product-variation label {
    font-weight: bold;
  }

  .edit-product-variation input[type="text"] {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 50px;
  }

  .quantity-control {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .quantity-control button {
    background-color: #eee;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
  }

  .add-variation {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }

  .edit-product-title,
  .edit-product-price,
  .edit-product-category {
    margin-bottom: 10px;
  }

  .edit-product-title input,
  .edit-product-price input,
  .edit-product-category input {
    width: 100%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .edit-icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    font-size: 16px;
    color: #007bff;
    cursor: pointer;
  }

  .save-button,
  .discard-button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }

  .add-variation-btn {
    margin-top: 20px;
  }


  .discard-button {
    background-color: #dc3545;
  }

  /* Container for search and sort */
  .search-sort-container {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 20px;
  }

  /* Search bar styling */
  .search-bar {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 25px;
    overflow: hidden;
    margin-right: 10px;
  }

  #search-input {
    border: none;
    padding: 10px;
    outline: none;
    width: 200px;
  }

  #search-btn {
    background-color: hsl(93, 100%, 20%);
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
  }

  #search-btn:hover {
    background-color: #0056b3;
  }

  #search-btn i {
    font-size: 16px;
  }
</style>