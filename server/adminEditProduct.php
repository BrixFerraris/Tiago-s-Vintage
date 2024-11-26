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
  } elseif ($role === 'Change Contents') {
    include_once './includes/sidebarChange_Contents.php';
  } else {
    include_once './includes/sidebar.php';
  }
} else {
  header("location: ../landing.php?error=NotLoggedIn");
  exit();
}
?>

<!-- Main -->
<main class="main-container">
  <link rel="stylesheet" href="../CSS/adminEditProduct.css">
  <div class="main-title">
    <p class="font-weight-bold">Edit Products</p>
  </div>

  <!-- edit products -->
  <!-- input code here -->


  <div class="edit-product">
    <div class="edit-product-left">
      <p class="font-weight-bold">Variations:</p>
      <div id="variations">

      </div>
      <p class="font-weight-bold">New Variation:</p>

      <div class="edit-product-variations">
        <div class="edit-product-variation">
          <form action="./includes/addVariation.php" method="post" enctype="multipart/form-data">
            <input name="product_id" type="hidden" id="product_id">
            <label for="name">Name:</label>
            <input name="Name" type="text" id="name" value="">
        </div>

        <div class="edit-product-variation">
          <label for="width">Width:</label>
          <input name="width" type="number" id="width">
        </div>

        <div class="edit-product-variation">
          <label for="length">Length:</label>
          <input name="length" type="number" id="length">
        </div>


        <div class="edit-product-variation">
          <label for="quantity">Quantity:</label>
          <input type="number" name="qty" id="quantity" value="0">
        </div>

        <div class="edit-product-variation">
          <label for="imgVar">Image</label>
          <input type="file" id="imgVar" name="imgVar" accept="image/*" required>
        </div>
      </div>

      <div class="add-variation-btn">
        <input type="submit" value="Add Variation" class="add-variation">
      </div>

    </div>
    </form>

    <div class="edit-product-right">
      <div class="edit-product-title">
        <p class="font-weight-bold">Product Title</p>
        <input id="title" type="text" value="Davey Allison 28 Big Print" placeholder="Product Title">
        <i class="fas fa-edit edit-icon"></i>
      </div>

      <div class="edit-product-price">
        <p class="font-weight-bold">Price</p>
        <input id="price" type="number" placeholder="Price">
        <i class="fas fa-edit edit-icon"></i>
      </div>

      <div class="edit-product-category">
        <select name="categories" id="categories">
          <option>Select Main Category</option>
        </select>
      </div>

      <button class="save-button">Save</button>
      <button class="discard-button">Discard</button>

    </div>
  </div>
</main>



<!-- Scripts -->

<script src="../test/sidebarToggle.js"></script>
<script>
  $(document).ready(function () {
    const url = new URL(window.location.href);
    const productID = url.searchParams.get('product_id');
    $('#product_id').val(productID);
    fetchCategories(productID);

    function fetchCategories(productID) {
      $.ajax({
        url: '../server/includes/getCategories.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
          var select = $('#categories');
          select.empty();

          if (Array.isArray(data) && data.length > 0) {
            $.each(data, function (index, category) {
              select.append(`<option value="${category.category}">${category.category}</option>`);
            });
          } else {
            select.append('<option>No categories found.</option>');
          }
          loadEdits(productID);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error("Error fetching categories: ", textStatus, errorThrown);
          $('#categories').append('<option>Error loading categories.</option>');
        }
      });
    }

    function loadVariations(productID) {
      $.ajax({
        url: './includes/getVariations.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ idProduct: productID }),
        success: function (data) {
          console.log(data);
          if (typeof data === "string") {
            data = JSON.parse(data);
          }
          if (data.type === "variations") {
            var variationDiv = $('#variations');
            variationDiv.empty();
            data.variations.forEach(function (variation) {
              var newDiv = $(`
                            <div id="variation1" class="variation1">
                            <div class="edit-product-variation">
                                <label for="name-${variation.id}">Name:</label>
                                <input class="input-edit" type="text" id="name-${variation.id}" value="${variation.variationName}" readonly>
                            </div>
                            <div class="edit-product-variation">
                                <label for="width-${variation.id}">Width:</label>
                                <input class="input-edit" type="text" id="width-${variation.id}" value="${variation.width}" readonly>
                            </div>
                            <div class="edit-product-variation">
                                <label for="length-${variation.id}">Length:</label>
                                <input class="input-edit" type="text" id="length-${variation.id}" value="${variation.length}" readonly>
                            </div>
                            <div class="edit-product-variation">
                                <label for="quantity-${variation.id}">Quantity:</label>
                                <input class="input-edit" type="number" id="quantity-${variation.id}" value="${variation.quantity}" readonly>
                                </div>
                            </div>
                            </div>
                            <br>
                        `);
              variationDiv.append(newDiv);
            });
          }
        },
        error: function (xhr, status, error) {
          console.error('Error loading variations:', error);
        }
      });
    }
    loadVariations(productID);

    function loadEdits(productID) {
      $.ajax({
        url: './includes/loadEdit.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ id: productID }),
        success: function (data) {
          if (typeof data === "string") {
            data = JSON.parse(data);
          }
          // console.log(data);
          if (data.type == "edit-product") {
            $('#title').val(data.title);
            $('#price').val(data.price);
            $('#categories').val(data.category).change();
          }
        },
        error: function (xhr, status, error) {
          console.error('Error loading edits:', error);
        }
      });
    }

  });
</script>
</body>

</html>