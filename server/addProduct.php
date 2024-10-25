
<?php
  include_once './includes/sidebar.php';
?>



      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">ADD PRODUCT</p>
        </div>

    <!-- form add products -->
    <div class="form-container">
        <form action="./includes/uploadSingleProduct.php" method="post" enctype="multipart/form-data">
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
                <label for="categories">Category</label>
                <select name="category" id="categories" required>
                    <option value="Tops">
                    <option value="Bottoms">
                    <option value="Shoes">
                    <option value="Accessories">
                </select>
            </div>
            <div class="form-group">
                <label for="sub_category">Sub Category</label>
                <select name="sub_category" id="sub_category" required>

                </select>
            </div>

            <div class="form-group">
                <label for="img1">Image 1</label>
                <input type="file" id="img1" name="img1" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="img2">Image 2</label>
                <input type="file" id="img2" name="img2" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="img3">Image 3</label>
                <input type="file" id="img3" name="img3" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="img4">Image 4</label>
                <input type="file" id="img4" name="img4" accept="image/*" required>
            </div>

            <button name="submit" type="submit">Add Product</button>
        </form>
    </div>
    </main>
    <!-- End Main -->

</div>

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


document.addEventListener('DOMContentLoaded', function () {
  // Websocket connection
  var conn = new WebSocket('ws://65.19.154.77:8080/ws/');
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
            var select2Instance = select2.select2;
            select2Instance.destroy();
            select2Instance.init();
        });
    };
});

</script>
  </body>
</html>

