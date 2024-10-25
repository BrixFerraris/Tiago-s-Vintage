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
          <select name="sub_category" id="sub_category">
            <option>Select Sub Category</option>
          </select>
      </div>

      <button class="save-button">Save</button>
      <button class="discard-button">Discard</button>
    </div>
  </div>
</main>

<!-- Modal Structure -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Edit Variation Details</h2>
  <div class="modal-var">

  
    <div class="edit-variation">
      <label for="modal-name">Name:</label>
      <input type="text" id="modal-name" value="White">
    </div>
      
    <div class="edit-variation">
      <label for="modal-width">Width:</label>
      <input type="number" id="modal-width" value="24">
    </div>
      
    <div class="edit-variation">
      <label for="modal-length">Length:</label>
      <input type="number" id="modal-length" value="29">
    </div>

    <div class="edit-variation">
      <label for="modal-quantity">Quantity:</label>
      <input type="number" id="modal-quantity" value="3">
    </div>

    <button class="save-modal">Save Changes</button>
  </div>
</div>
</div>


<style>


</style>

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

// MODAL LOGIC
const modal = document.getElementById("editModal");
const editIcons = document.querySelectorAll(".edit-iconn");
const span = document.getElementsByClassName("close")[0];

// When the user clicks the edit icon, open the modal
editIcons.forEach(icon => {
  icon.onclick = function() {
    modal.style.display = "block";
  };
});

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
function loadCategory() {
    var conn = new WebSocket('ws://localhost:8080');
    var select1 = document.getElementById('categories');
    var select2 = document.getElementById('sub_category');
    var categories = [];

    conn.onopen = function() {
        conn.send(JSON.stringify({ type: 'loadCategories' }));
    };

    conn.onmessage = function(e) {
        var data = JSON.parse(e.data);
        if (Array.isArray(data)) {
            categories.push(...data);
        } else {
            categories.push(data);
        }
        // console.log(categories);
        select1.innerHTML = ''; 
        categories.forEach(function(category) {
            var optionExists = false;
            for (var i = 0; i < select1.options.length; i++) {
                if (select1.options[i].value === category.parent) {
                    optionExists = true;
                    break;
                }
            }
            if (!optionExists) {
                var option = document.createElement('option');
                option.text = category.parent;
                option.value = category.parent;
                select1.add(option);
            }
        });

        select1.addEventListener('change', function() {
            var selectedValue = select1.value;
            select2.innerHTML = ''; 
            var filteredOptions = categories.filter(function(category) {
                return category.parent === selectedValue;
            });

            filteredOptions.forEach(function(category) {
                var option = document.createElement('option');
                option.text = category.child;
                option.value = category.child;
                select2.add(option);
            });

            // $(select2).select2();
        });
    };

    conn.onerror = function(error) {
        console.error('WebSocket Error: ', error);
    };

    conn.onclose = function() {
        console.log('WebSocket connection closed');
    };
}

//Websocket connection
var conn = new WebSocket('ws://65.19.154.77:8080/ws/');
const url = new URL(window.location.href);
const productID = url.searchParams.get('product_id');
loadCategory();
  conn.onopen = function() {
    conn.send(JSON.stringify({ type: 'loadVariations', idProduct: productID }));
    conn.send(JSON.stringify({ type: 'loadEdits', id: productID }));
  };

  conn.onmessage = function(e) {
    var data = JSON.parse(e.data);
    console.log(data);
    if (data.type === 'variations') {
      var variationDiv = document.getElementById('variations');
      variationDiv.innerHTML = '';
      data.variations.forEach(function(variation) {
      var newDiv = document.createElement('div');
      newDiv.classList.add('edit-product-variation');
      newDiv.innerHTML = `
                      <div class="edit-product-variation">
                          <label for="name">Name:</label>
                          <input type="text" id="name" value="${variation.variationName}" readonly>
                      </div>
                      <div class="edit-product-variation">
                          <label for="width">Width:</label>
                          <input type="text" id="width" value="${variation.width}" readonly>
                      </div>
                      <div class="edit-product-variation">
                          <label for="length">Length:</label>
                          <input type="text" id="length" value="${variation.length}" readonly>
                      </div>
                      <div class="edit-product-variation">
                          <label for="quantity">Quantity:</label>
                          <div class="quantity-control">
                              <input type="number" id="quantity" value="${variation.quantity}" readonly>
                          </div>
                        <div class="edit-product-variation">
                          <span class="material-icons-outlined edit-iconn edit-variation" data-id="${variation.id}" style="cursor:pointer;"> edit </span>
                        </div>
                      </div>
                      <br>
                     
                  `;

      variationDiv.appendChild(newDiv);
      });
    } 
     if (data.type === 'edit-product') {
        var title = document.getElementById("title");
        var price = document.getElementById("price");
        var category = document.getElementById("categories");
        var sub_category = document.getElementById("sub_category");
        title.value = data.title;
        price.value = data.price;
        category.value = data.category;
        sub_category.value = data.sub_category;
    } 
    if (data.type === 'productEdited') {
        alert('Product successfully updated');
    } 
  };
document.addEventListener("DOMContentLoaded", function() {
  document.addEventListener("click", function(event) {
  const url = new URL(window.location.href);
  const productID = url.searchParams.get('product_id');
  document.getElementById('product_id').value = productID;
    if (event.target.classList.contains('save-button')) {
      var title = document.getElementById("title").value;
      var price = document.getElementById("price").value;
      var category = document.getElementById("categories").value;
      var sub_category = document.getElementById("sub_category").value;
      conn.send(JSON.stringify({ type: 'editProduct', id: productID, title: title, price: price, category: category, subCategory: sub_category, price}));
    }
    if (event.target.classList.contains('discard-button')) {
      window.location.href = "./product.php"
    }
    if (event.target.classList.contains('edit-variation')) {
      var id = event.target.getAttribute('data-id');
      conn.send(JSON.stringify({ type: 'loadEditVariation', id: id}));
    }
  });
});

</script>
</body>
</html>
