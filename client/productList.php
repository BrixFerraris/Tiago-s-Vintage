<?php
include './header.php';
?>

<div class="box">
  <div id="search-filters">
    <input type="text" id="search-input" placeholder="Search Products...">
    
    <select id="categories">
        <option value="" >Select a category</option>
    </select>


  </div>


  <div id="fixed-grid" class="fixed-grid">
    <!-- Existing product cells will be dynamically added here -->
  </div>
</div>
<script>

  //Search itu sa admin Products
  document.getElementById('search-input').addEventListener('input', function() {
    var searchValue = this.value;
    fetchProducts(searchValue);
});

function fetchProducts(searchValue) {
  var conn = new WebSocket('ws://65.19.154.77:6969/ws/');
    conn.onopen = function() {
        conn.send(JSON.stringify({ type: 'searchProducts', title: searchValue }));

    };


    conn.onmessage = function(e) {
        var data = JSON.parse(e.data);
        // console.log(data);
        if (data.type === 'searchResults') {
            displayProducts(data.products);
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
                <a href="./newItem.php?productID=${product.id}">
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
    // WebSocket connection
    var conn = new WebSocket('ws://65.19.154.77:6969/ws/');
    var productDiv = document.getElementById('fixed-grid');
    var products = [];
    var select1 = document.getElementById('categories');
    var select2 = document.getElementById('sub_category');
    const url = new URL(window.location.href);
    const productCategory = url.searchParams.get('category');
    var categories = [];
    
    console.log(select1.value);

 
    conn.onopen = function() {
        conn.send(JSON.stringify({ type: 'loadProducts' }));
        conn.send(JSON.stringify({ type: 'loadCategories' }));
    };

    conn.onmessage = function(e) {
        var data = JSON.parse(e.data);
        // console.log(data);
        if (data.type === 'product') {
            productDiv.innerHTML = '';
              products.forEach(function(data) {
                  var newDiv = document.createElement('div');
                  newDiv.className = 'cell';
                  newDiv.innerHTML = `
                      <a href="./newItem.php?productID=${data.id}">
                          <img src="../server/includes/uploads/${data.img1}" alt="${data.title}" width="252" height="320">
                          <p>
                              <span class="has-text-primary has-text-weight-bold">${data.title}</span><br>
                              <span class="has-text-primary has-text-weight-semibold">PHP ${data.price}</span>
                          </p>
                      </a>
                  `;
                  productDiv.appendChild(newDiv);
          });
        }


        if (productCategory === 'Tops') {
            if (data.category === 'Tops') {
                products.push(data);
            }
        }
        else if (productCategory === 'Bottom') {
            if (data.category === 'Bottoms') {
                products.push(data);
            }
        }
        else if (productCategory === 'Shoes') {
            if (data.category === 'Shoes') {
                products.push(data);
            }
        }
        else if (productCategory === 'Accessories') {
            if (data.category === 'Accessories') {
                products.push(data);
            }
        }
        else {
          products.push(data);
        }
        

        
        if (Array.isArray(data)) {
            categories.push(...data);
        } 
        console.log(categories);
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
    window.location.href = "productList.php?category=" + selectedValue;

    // Clear previous options from select2
    select2.innerHTML = '';

    // Re-add the default "Select a category" option to select2
    var defaultOption = document.createElement('option');
    defaultOption.text = 'Select a category';
    defaultOption.value = ''; // Keep it empty to serve as the default placeholder
    select2.add(defaultOption);

    // Filter categories based on the selected value from select1
    var filteredOptions = categories.filter(function(category) {
        return category.parent === selectedValue;
    });

    // Populate select2 with filtered options
    filteredOptions.forEach(function(category) {
        var option = document.createElement('option');
        option.text = category.child;
        option.value = category.child;
        select2.add(option);
    });

    // Destroy the select2 instance if it already exists
    if ($.fn.select2) {
        $(select2).select2('destroy');
    }

    // Re-initialize select2 after options are added
    $(select2).select2();

        });
    };
});
</script>


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
  }

  .cell .has-text-primary {
    color: #28a745;
  }

  .cell .has-text-weight-bold {
    font-weight: bold;
  }
  /* search dropdown */ 

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
