
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

$(document).ready(function() {
    function fetchCategories() {
        $.ajax({
            url: '../server/includes/getCategories.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#categories').empty(); 
                if (Array.isArray(data) && data.length > 0) {
                    $('#categories').append('<option value="">Select a category</option>'); 
                    $.each(data, function(index, category) {
                        $('#categories').append(`
                            <option value="${category.category}">${category.category}</option>
                        `);
                    });
                } else {
                    $('#categories').append('<option value="">No categories found</option>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching categories: ", textStatus, errorThrown);
                $('#categories').append('<option value="">Error loading categories</option>');
            }
        });
    }
    fetchCategories(); 
});

</script>
  </body>
</html>

