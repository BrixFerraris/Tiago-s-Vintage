
<?php
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Add Product</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../CSS/addproduct.css">
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          <span class="material-icons-outlined">search</span>
        </div>
        <div class="header-right">
          <span class="material-icons-outlined">notifications</span>
          <span class="material-icons-outlined">email</span>
          <span class="material-icons-outlined">account_circle</span>
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">store</span> Tiago's Vintage
          </div>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="../HTML/admindashboard.php" target="_blank">
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">inventory_2</span> Products
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">add</span> Add Product
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">fact_check</span> Inventory
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">group</span> Admin profile
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">add_shopping_cart</span> Purchase Orders
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">shopping_cart</span> Sales Orders
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">poll</span> Reports
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">web</span> Page management
            </a>
          </li>
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">Add Products</p>
        </div>

    <!-- form add products -->
    <div class="form-container">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Product Title</label>
                <input type="text" id="title" name="title" placeholder="Title" required>
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
                <label for="sale">Special Offer/Sale</label>
                <input type="text" id="sale" name="sale" placeholder="Sale %" required>
            </div>

            <div class="form-group">
    <label for="category1">Category 1</label>
    <select id="category1" name="category1" required>
        <option value="tops">Tops</option>
        <option value="bottoms">Bottoms</option>
        <option value="shoes">Shoes</option>
        <option value="accessories">Accessories</option>
    </select>
</div>

<div class="form-group">
    <label for="category2">Category 2</label>
    <select id="category2" name="category2" required>
        <!-- Options will be populated dynamically -->
    </select>
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
                        <input type="number" name="length[]" placeholder="Length" required>
                        <input type="number" name="width[]" placeholder="Width" required>
                    </div>
            </div>

            <div class="form-group">
                <label for="image1">Image 1</label>
                <input type="file" id="image1" name="image1" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="image2">Image 2</label>
                <input type="file" id="image2" name="image2" accept="image/*">
            </div>

            <div class="form-group">
                <label for="image2">Image 3</label>
                <input type="file" id="image2" name="image2" accept="image/*">
            </div>

            <div class="form-group">
                <label for="image2">Image 4</label>
                <input type="file" id="image2" name="image2" accept="image/*">
            </div>

            <button type="submit">Add Product</button>
        </form>
    </div>
      </main>
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


//category
document.addEventListener('DOMContentLoaded', function () {
    const category1 = document.getElementById('category1');
    const category2 = document.getElementById('category2');

    const options = {
        tops: [
            { value: 'tshirt', text: 'T-shirt' },
            { value: 'longsleeve', text: 'Long Sleeve' },
            { value: 'hoodie', text: 'Hoodie' },
            { value: 'jackets', text: 'Jackets' },
            { value: 'vest', text: 'Vest' }
        ],
        bottoms: [
            { value: 'short', text: 'Short' },
            { value: 'pants', text: 'Pants' },
            { value: 'doubleknee', text: 'Double Knee' }
        ],

        shoes: [
            { value: 'running shoes', text: 'Running Shoes' },
            { value: 'cashual shoes', text: 'Casual Shoes' },
        ],

        accessories: [
            { value: 'caps', text: 'Caps' },
            { value: 'glasses', text: 'Glasses' },
        ]
        // You can add more categories and their options here
    };

    category1.addEventListener('change', function () {
        const selectedCategory = this.value;
        // Clear existing options
        category2.innerHTML = '';

        // Populate new options
        if (options[selectedCategory]) {
            options[selectedCategory].forEach(function (option) {
                const opt = document.createElement('option');
                opt.value = option.value;
                opt.textContent = option.text;
                category2.appendChild(opt);
            });
        }
    });

    // Trigger change event on page load to populate Category 2 based on default Category 1 value
    category1.dispatchEvent(new Event('change'));
});

</script>
  </body>
</html>

