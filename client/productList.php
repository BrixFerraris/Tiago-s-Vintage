<?php
include './header.php';
?>

<style>
  body {
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }

  .box {
    margin: 20px auto;
    padding: 20px;
    max-width: 1200px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .fixed-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    justify-content: center;
  }

  .cell {
    max-width: 300px;
    margin: 0 auto;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .cell img {
    width: 220px;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .cell:hover img {
    transform: scale(1.1);
  }

  .cell p {
    padding: 15px;
  }

  .cell .has-text-primary {
    color: #28a745;
  }

  .cell .has-text-weight-bold {
    font-weight: bold;
  }
</style>

<div class="box">
  <div id="fixed-grid" class="fixed-grid">
    <!-- Existing product cells will be dynamically added here -->
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // WebSocket connection
    var conn = new WebSocket('ws://localhost:8080');
    var productDiv = document.getElementById('fixed-grid');
    var products = [];

    conn.onopen = function() {
        conn.send(JSON.stringify({ type: 'loadProducts' }));
    };

    conn.onmessage = function(e) {
        var product = JSON.parse(e.data);
        products.push(product);
        productDiv.innerHTML = '';
        products.forEach(function(product) {
            var newDiv = document.createElement('div');
            newDiv.className = 'cell';
            newDiv.innerHTML = `
                <a href="./newItem.php?productID=${product.id}">
                    <img src="../server/includes/uploads/${product.img1}" alt="${product.title}" width="252" height="320">
                    <p>
                        <span class="has-text-primary has-text-weight-bold">${product.title}</span><br>
                        <span class="has-text-primary is-subtitle">${product.description}</span><br>
                        <span class="has-text-primary has-text-weight-semibold">PHP ${product.price}</span>
                    </p>
                </a>
            `;
            productDiv.appendChild(newDiv);
        });
    };
});
</script>





<?php
include 'footer.php';
?>
