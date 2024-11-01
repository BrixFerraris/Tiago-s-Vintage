<?php
  include_once './includes/sidebar.php';
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
      
      <div id="variations" class="variations">
        <div class="edit-product-variation">
          <label for="name">Name:</label>
          <input type="text" id="name" value="White" readonly="readonly">
        </div>

        <div class="edit-product-variation">
          <label for="width">Width:</label>
          <input type="text" id="width" value="24" readonly="readonly">
        </div>

        <div class="edit-product-variation">
          <label for="length">Length:</label>
          <input type="text" id="length" value="29" readonly="readonly">
        </div>

        <div class="edit-product-variation">
          <label for="quantity">Quantity:</label>
          <div class="quantity-control">
            <input type="number" id="quantity" value="3" readonly="readonly">
          </div>
        </div>

        <div class="edit-product-variation">
          <span class="material-icons-outlined edit-iconn" style="cursor:pointer;"> edit </span>
        </div>
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
          <div class="quantity-control">
            <input name="qty" type="number" id="quantity" value="3">
          </div>
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
        <input id="price" type="number"  placeholder="Price">
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

<style>


</style>

<!-- Scripts -->
<script>
$(document).ready(function() {
    const url = new URL(window.location.href);
    const productID = url.searchParams.get('product_id');

    fetchCategories(productID);
    loadVariations(productID);

    function fetchCategories(productID) {
        $.ajax({
            url: '../server/includes/getCategories.php', 
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var select = $('#categories');
                select.empty(); 

                if (Array.isArray(data) && data.length > 0) {
                    $.each(data, function(index, category) {
                        select.append(`<option value="${category.category}">${category.category}</option>`);
                    });
                } else {
                    select.append('<option>No categories found.</option>');
                }
                loadEdits(productID);
            },
            error: function(jqXHR, textStatus, errorThrown) {
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
            success: function(data) {
                if (typeof data === "string") {
                    data = JSON.parse(data);
                }
                if (data.type === "variations") {
                    var variationDiv = $('#variations');
                    variationDiv.empty();
                    data.variations.forEach(function(variation) {
                        var newDiv = $(`
                            <div class="edit-product-variation">
                                <label for="name-${variation.id}">Name:</label>
                                <input type="text" id="name-${variation.id}" value="${variation.variationName}" readonly>
                            </div>
                            <div class="edit-product-variation">
                                <label for="width-${variation.id}">Width:</label>
                                <input type="text" id="width-${variation.id}" value="${variation.width}" readonly>
                            </div>
                            <div class="edit-product-variation">
                                <label for="length-${variation.id}">Length:</label>
                                <input type="text" id="length-${variation.id}" value="${variation.length}" readonly>
                            </div>
                            <div class="edit-product-variation">
                                <label for="quantity-${variation.id}">Quantity:</label>
                                <input type="number" id="quantity-${variation.id}" value="${variation.quantity}" readonly>
                                <span class="material-icons-outlined edit-iconn edit-variation" data-id="${variation.id}" style="cursor:pointer;"> edit </span>
                            </div>
                            <br>
                        `);
                        variationDiv.append(newDiv);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading variations:', error);
            }
        });
    }

    function loadEdits(productID) {
        $.ajax({
            url: './includes/loadEdit.php', 
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: productID }),
            success: function(data) {
                if (typeof data === "string") {
                    data = JSON.parse(data); 
                }
                console.log(data);
                if (data.type == "edit-product") {
                    $('#title').val(data.title);
                    $('#price').val(data.price);
                    $('#categories').val(data.category).change();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading edits:', error);
            }
        });
    }
});
</script>
</body>
</html>
