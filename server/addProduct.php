
<?php
  include_once './includes/sidebar.php';
?>



      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">Add Products</p>
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
                        <input type="number" name="length" placeholder="Length" required>
                        <input type="number" name="width" placeholder="Width" required>
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

            <button name="submit" type="submit">Add Product</button>
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

});

</script>
  </body>
</html>

