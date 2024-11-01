<?php
include './header.php';
?>

<div class="box">
  <div class="search-filter" id="search-filters">
  <a href="../client/shop.php" style="text-decoration: none;"><button>Back</button></a>
    <input type="text" id="search-input" placeholder="Search Products...">



  </div>


  <div id="fixed-grid" class="fixed-grid">
    <!-- Existing product cells will be dynamically added here -->
  </div>
</div>
<script>

  //Search itu sa admin Products
  document.getElementById('search-input').addEventListener('input', function() {
    var searchValue = this.value;
    const url = new URL(window.location.href);
    const productCategory = url.searchParams.get('category');
    fetchProducts(searchValue, productCategory);
});

function fetchProducts(searchValue, productCategory) {
    var conn = new WebSocket('ws://localhost:8080/ws/');

    conn.onopen = function() {
        conn.send(JSON.stringify({ type: 'searchProducts', title: searchValue, category: productCategory }));
    };

    conn.onmessage = function(e) {
        var data = JSON.parse(e.data);
        if (data.type === 'searchResults') {
            displayProducts(data.products || []);
        }
    };
}

function displayProducts(products) {
    var productDiv = document.getElementById('fixed-grid');
    productDiv.innerHTML = ''; 
    var uniqueProducts = new Set();
    products.forEach(product => {
        if (!uniqueProducts.has(product.id)) { 
            uniqueProducts.add(product.id); 

            var newDiv = document.createElement('div');
            newDiv.className = 'cell';
            newDiv.innerHTML = `
                <a href="./newItem.php?productID=${product.id}" style="text-decoration: none;">
                    <img src="../server/includes/uploads/${product.img1}" alt="${product.title}" width="252" height="320">
                    <p>
                        <span class="has-text-primary has-text-weight-bold">${product.title}</span><br>
                        <span class="has-text-primary has-text-weight-semibold">PHP ${product.price}</span>
                    </p>
                </a>
            `;
            productDiv.appendChild(newDiv);
        }
    });
}
document.addEventListener('DOMContentLoaded', function() {
    var conn = new WebSocket('ws://localhost:8080/ws/');
    const productDiv = document.getElementById('fixed-grid');
    const url = new URL(window.location.href);
    const productCategory = url.searchParams.get('category');

    conn.onopen = function() {
        conn.send(JSON.stringify({ type: 'getProductsByCategory', category: productCategory }));
    };

    conn.onmessage = function(e) {
        var data = JSON.parse(e.data);

        if (data.type === 'categoryProducts') {
            const products = Array.isArray(data.products) ? data.products : [data.products];
            displayFilteredProducts(products, productCategory);
        } else {
            console.error("No products available or data format is incorrect", data);
            productDiv.innerHTML = '<p>No products available.</p>';
        }
    };
});

function displayFilteredProducts(products, category) {
    const productDiv = document.getElementById('fixed-grid');
    productDiv.innerHTML = ''; 

    const filteredProducts = products.filter(product => 
        product && product.category && (!category || product.category === category)
    );

    if (filteredProducts.length === 0) {
        productDiv.innerHTML = '<p>No products available in this category.</p>';
        return;
    }

    filteredProducts.forEach(product => {
        var newDiv = document.createElement('div');
        newDiv.className = 'cell';
        newDiv.innerHTML = `
            <a href="./newItem.php?productID=${product.id}" style="text-decoration: none;">
                <img src="../server/includes/uploads/${product.img1}" alt="${product.title}" width="252" height="320">
                <p>
                    <span class="has-text-primary has-text-weight-bold">${product.title}</span><br>
                    <span class="has-text-primary has-text-weight-semibold">PHP ${product.price}</span>
                </p>
            </a>
        `;
        productDiv.appendChild(newDiv);
    });
}
</script>


<style>
  body {
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }

  .box {
    margin-bottom: 100px;
    margin: 20px auto;
    padding: 20px;
    max-width: 1500px;
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
    text-decoration: none;
  }
  .cell .has-text-primary {
    color: #28a745;
  }

  .cell .has-text-weight-bold {
    font-weight: bold;
  }
  /* search dropdown */ 
  .search-filter button{
    padding: 10px 20px;
    background-color: green;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100px;
  }
  /* Search filters styling */
  #search-filters {
    display: flex;
    gap: 15px;
    margin-bottom: 25px;
    align-items: center;
  }

  /* Styled search bar */
  #search-input {
    padding: 10px;
    width: 250px;
    border-radius: 25px;
    border: 1px solid #ccc;
    outline: none;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  #search-input:focus {
    border-color: #4CAF50;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  /* Styled dropdowns */
  .box {
    display: flex;
    flex-direction: column;
    padding: 20px;
  }

  /* Search filters styling */
  #search-filters {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    align-items: center;
  }

  /* Styled search bar */
  #search-bar {
    padding: 10px 40px 10px 15px;
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 20px;
    outline: none;
    font-size: 16px;
    transition: border-color 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  /* Search button */
  #search-bar::placeholder {
    color: #999;
  }

  #search-bar:focus {
    border-color: #4CAF50;
  }

  /* Styled dropdowns */
  select {
    padding: 10px;
    border-radius: 20px;
    border: 1px solid #ccc;
    background-color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: border-color 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  select:hover, select:focus {
    border-color: #4CAF50;  
  }


  /* Layout for product grid */
  #fixed-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    #search-filters {
      flex-direction: column;
      gap: 10px;
    }
  }

   /* Apply button styling */
   #apply-button {
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    background-color: hsl(93, 100%, 20%);
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }

  /* Button hover effect */
  #apply-button:hover {
    background-color: #45a049; /* Darker green on hover */
    
  }
</style>




<?php
include 'footer.php';
?>
