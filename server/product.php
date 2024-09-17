<?php
  include_once './includes/sidebar.php';
?>
<style>
  .is-invisible {
    display: none;
  }
  body {
  font-family: 'Arial', sans-serif;
  background-color: #f5f5f5;
  margin: 0;
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
  margin-bottom: 20px;
}

.main-title p {
  font-size: 24px;
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

.edit-product-title, .edit-product-price, .edit-product-category {
  margin-bottom: 10px;
}

.edit-product-title input, .edit-product-price input, .edit-product-category input {
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

.save-button, .discard-button {
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

      <!-- edit Main -->
      <main id="edit-container" class="is-invisible main-container">
        <div class="main-title">
          <p class="font-weight-bold">Edit Products</p>
          <p id="edit-id"></p>
        </div>

    <!-- edit products -->


    <div class="edit-product">
      <div class="edit-product-left">
       <input type="hidden" name="id" id="product-id">


        <p class="font-weight-bold">Variations:</p>
        <div class="edit-product-variations">
          
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
          <input type="text" id="category1" placeholder="Category">
          <i class="fas fa-edit edit-icon"></i>
        </div>

        <button class="save-button">Save</button>
        <button class="discard-button">Discard</button>

      </div>
      
    </div>
    <div class="add-variation-btn">
      <button class="add-variation">Add Variation</button>
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
        var category = document.getElementById("category1");
        var qty = document.getElementById("qty");
        var id = document.getElementById("product-id");
        title.value = product.title;
        id.value = product.id;
        price.value = product.price;
        category.value = product.category;
        qty.value = product.qty;
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
    } else if (event.target.classList.contains('save-button')) {
    var id = document.getElementById("product-id").value;
    var title = document.getElementById("title").value;
    var price = document.getElementById("price").value;
    var category = document.getElementById("category1").value;

    console.log('Sending editProduct message:', { type: 'editProduct', id: id });
    conn.send(JSON.stringify({
        type: 'editProduct',
        id: id,
        title: title,
        price: price,
        category: category,
    }));

    // var formData = new FormData();
    // formData.append('id', id);
    // var files = ['img1', 'img2', 'img3', 'img4'];
    // files.forEach(function(fileId) {
    //     var fileInput = document.getElementById(fileId);
    //     if (fileInput.files.length > 0) {
    //         formData.append(fileId, fileInput.files[0]);
    //     }
    // });

    // fetch('./includes/editProduct.php', {
    //     method: 'POST',
    //     body: formData
    // })
    // .then(response => response.json())
    // .then(data => console.log('POST request successful:', data))
    // .catch(error => console.error('Error in POST request:', error));
} else if (event.target.classList.contains('add-variation')){
    console.log('Sending editProduct message:', { type: 'editProduct', id: id });
    conn.send(JSON.stringify({
        type: 'editProduct',
        id: id,
        title: title,
        price: price,
        category: category,
    }));
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