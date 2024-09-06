<?php
  include_once './includes/sidebar.php';
?>
<style>
  .is-invisible {
    display: none;
  }
</style>

      <!-- Main -->
      <main id="container" class="main-container ">
        <div class="main-title">
          <p class="font-weight-bold">PRODUCTS</p>
        </div>

        <div class="content">
            <h1>Products</h1>
            <table id="products" >
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Offer</th>
                        <th>Product Category</th>
                        <th>Product Color</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="products-body" >

                </tbody>
            </table>
            <!-- Pagination -->
            <div class="pagination">
                <a href="#" class="prev">Previous</a>
                <a href="#" class="page-num">1</a>
                <a href="#" class="page-num">2</a>
                <a href="#" class="next">Next</a>
            </div>
    </div>
    </main>

    <main id="edit-container" class="main-container is-invisible">
        <div class="main-title">
          <p class="font-weight-bold">Edit Product</p>
          <p id="edit-id"></p>
        </div>

    <!-- form edit products -->
    <div class="form-container">
        <form action="./includes/editProduct.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Product Title</label>
                <input type="text" id="title" name="title" placeholder="Title" required>
                <input type="hidden" name="id" id="product-id">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Description" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price (PHP)</label>
                <input type="text" id="price" name="price" placeholder="Price (PHP)" required
                pattern="^\d+(\.\d{2})?$" title="Enter a valid amount in PHP, e.g., 123.45">
            </div>

            <div class="form-group">
                <label for="discount">Special Offer/Sale</label>
                <input type="text" id="discount" name="discount" placeholder="Sale %" required>
            </div>

            <div class="form-group">
                <label for="category1">Category 1</label>
                <input list="categories" id="category1" name="category1">
                <datalist id="categories">
                    <option value="Tops">
                    <option value="Bottoms">
                    <option value="Shoes">
                    <option value="Date">
                    <option value="Accessories">
                </datalist>
            </div>


            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" id="color" name="color" placeholder="Color" required>
            </div>

            <div class="form-group sizes-container">
                <label for="sizes">Sizes</label>
                    <div class="size-entry">
                        <select id="size" name="size" required>
                            <option value="Kids">Kids</option>
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="Large">Large</option>
                            <option value="XLArge">XLarge</option>
                            <option value="XXLarge">XXLarge & up</option>
                        </select>
                    </div>
            </div>
            <div class="form-group dimes-container">
                <label for="dimes">Dimes</label>
                    <div class="dimes-entry">
                        <input id="length" type="number" name="length" placeholder="Length" required>
                        <input id="width" type="number" name="width" placeholder="Width" required>
                    </div>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="qty" name="qty" placeholder="Quantity" required>
            </div>

            <div class="form-group">
                <label for="img1">Image 1</label>
                <input type="file" id="img1" name="img1" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="img2">Image 2</label>
                <input type="file" id="img2" name="img2" accept="image/*">
            </div>

            <div class="form-group">
                <label for="img3">Image 3</label>
                <input type="file" id="img3" name="img3" accept="image/*">
            </div>

            <div class="form-group">
                <label for="img4">Image 4</label>
                <input type="file" id="img4" name="img4" accept="image/*">
            </div>
            <button class="edit-product" name="submit" type="submit">Submit</button>
        </form>
    </div>
      </main>
<!-- End Main -->
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



// WebSocket connection
var conn = new WebSocket('ws://localhost:8080');
conn.onopen = function() {
    conn.send(JSON.stringify({ type: 'loadProducts' }));
};

conn.onmessage = function(e) {
    var product = JSON.parse(e.data);
    var id = document.getElementById("edit-id").value;
    if (product.type === 'product') {
        var table = document.getElementById('products').getElementsByTagName('tbody')[0];
        var newRow = table.insertRow();
        var id = product.id;
        newRow.insertCell(0).setAttribute("product-id", id);
        newRow.insertCell(0).innerText = product.id;
        newRow.insertCell(1).innerHTML = '<img src="./includes/uploads/' + product.img1 + '" alt="Product Image">';
        newRow.insertCell(2).innerText = product.title;
        newRow.insertCell(3).innerText = product.price;
        newRow.insertCell(4).innerText = product.discount;
        newRow.insertCell(5).innerText = product.category;
        newRow.insertCell(6).innerText = product.color;
        newRow.insertCell(7).innerHTML = '<button class="edit-btn" data-id="' + product.id + '">Edit</button>';
        newRow.insertCell(8).innerHTML = '<button class="delete-btn" data-id="' + product.id + '">Delete</button>';
    } else if (product.type === 'productDeleted') {
        var table = document.getElementById('products').getElementsByTagName('tbody')[0];
        var rows = table.rows;
        for (var i = 0; i < rows.length; i++) {
            if (rows[i].cells[0].innerText === product.id) {
                table.deleteRow(i);
                break;
            }
        }
    } else if (product.type === 'edit-product') {
        var title = document.getElementById("title");
        var price = document.getElementById("price");
        var discount = document.getElementById("discount");
        var category = document.getElementById("category1");
        var color = document.getElementById("color");
        var size = document.getElementById("size");
        var length = document.getElementById("length");
        var width = document.getElementById("width");
        var qty = document.getElementById("qty");
        var id = document.getElementById("product-id");
        var description = document.getElementById("description");
        title.value = product.title;
        id.value = product.id;
        price.value = product.price;
        discount.value = product.discount;
        category.value = product.category;
        color.value = product.color;
        size.value = product.size;
        length.value = product.length;
        width.value = product.width;
        qty.value = product.qty;
        description.value = product.description;
    } else if (product.type === 'productEdited') {
        window.location.href = 'product.php';
    }
};

document.addEventListener('DOMContentLoaded', function() {
document.addEventListener('click', function(event) {

    if (event.target.classList.contains('delete-btn')) {
        var id = event.target.getAttribute('data-id');
        console.log('Sending deleteProduct message:', { type: 'deleteProduct', id: id });
        conn.send(JSON.stringify({ type: 'deleteProduct', id: id }));
    } 
    else if (event.target.classList.contains('edit-btn')) {
      var id = event.target.getAttribute('data-id');
      var container = document.getElementById('container');
      var editForm = document.getElementById('edit-container');
      document.getElementById("edit-id").innerText = event.target.getAttribute('data-id');
      document.getElementById("edit-id").setAttribute('data-id', id);
      container.classList.add('is-invisible');
      editForm.classList.remove('is-invisible');
      conn.send(JSON.stringify({ type: 'loadEdits', id:id }));
    } else if (event.target.classList.contains('edit-product')) {
    var id = document.getElementById("product-id").getAttribute('data-id');
    var title = document.getElementById("title").value;
    var price = document.getElementById("price").value;
    var discount = document.getElementById("discount").value;
    var category = document.getElementById("category1").value;
    var color = document.getElementById("color").value;
    var size = document.getElementById("size").value;
    var length = document.getElementById("length").value;
    var width = document.getElementById("width").value;
    var qty = document.getElementById("qty").value;
    var description = document.getElementById("description").value;

    console.log('Sending editProduct message:', { type: 'editProduct', id: id });
    conn.send(JSON.stringify({
        type: 'editProduct',
        id: id,
        title: title,
        price: price,
        discount: discount,
        category: category,
        color: color,
        size: size,
        length: length,
        width: width,
        qty: qty,
        description: description
    }));

    var formData = new FormData();
    console.log(id);
    console.log(document.getElementById('product-id').value);
    formData.append('id', document.getElementById('product-id').value);
    formData.append('img1', document.getElementById('img1').files[0]);
    formData.append('img2', document.getElementById('img2').files[0]);
    formData.append('img3', document.getElementById('img3').files[0]);
    formData.append('img4', document.getElementById('img4').files[0]);

    fetch('./includes/editProduct.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => console.log('POST request successful:', data))
    .catch(error => console.error('Error in POST request:', error));
}

});

});
conn.onerror = function(error) {
    console.error('WebSocket Error: ', error);
};

conn.onclose = function() {
    console.log('WebSocket connection closed');
};


    </script>
</body>
</html>