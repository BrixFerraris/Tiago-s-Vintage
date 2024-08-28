<?php
  include_once './includes/sidebar.php';
?>

      <!-- Main -->
      <main class="main-container">
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
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
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
    if (product.type === 'product') {
      var product = JSON.parse(e.data);
      var table = document.getElementById('products').getElementsByTagName('tbody')[0];
      var newRow = table.insertRow();
      newRow.insertCell(0).innerText = product.id;
      newRow.insertCell(1).innerHTML = '<img src="./includes/uploads/' + product.img1 + '" alt="Product Image">';
      newRow.insertCell(2).innerText = product.title;
      newRow.insertCell(3).innerText = product.price;
      newRow.insertCell(4).innerText = product.discount;
      newRow.insertCell(5).innerText = product.cat1;
      newRow.insertCell(6).innerText = product.color;
      newRow.insertCell(7).innerHTML = '<button class="edit-btn">Edit</button>';
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
    }
};

document.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-btn')) {
        var id = event.target.getAttribute('data-id');
        console.log('Sending deleteProduct message:', { type: 'deleteProduct', id: id });
        conn.send(JSON.stringify({ type: 'deleteProduct', id: id }));
    }
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