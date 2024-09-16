
<?php
  include_once './includes/sidebar.php';
?>



      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">Edit Products</p>
        </div>

    <!-- edit products -->
    <!-- input code here -->


    <div class="edit-product">
      <div class="edit-product-left">

        <div class="edit-product-images">
          <img src="https://i.ibb.co/0n98C8r/25-19.jpg" alt="Product Image 1">
          <img src="https://i.ibb.co/0n98C8r/25-19.jpg" alt="Product Image 2">
          <img src="https://i.ibb.co/0n98C8r/25-19.jpg" alt="Product Image 3">
          <img src="https://i.ibb.co/0n98C8r/25-19.jpg" alt="Product Image 4">
        </div>

        <p class="font-weight-bold">Variations:</p>
        <div class="edit-product-variations">
          
          <div class="edit-product-variation">
            <label for="color">Color:</label>
            <input type="text" id="color" value="Blue">
          </div>

          <div class="edit-product-variation">
            <label for="width">Width:</label>
            <input type="text" id="width">
          </div>

          <div class="edit-product-variation">
            <label for="length">Length:</label>
            <input type="text" id="length">
          </div>

          <div class="edit-product-variation">
            <label for="quantity">Quantity:</label>
            <div class="quantity-control">
              
              <input type="number" id="quantity" value="3">
              
            </div>

          </div>

          

        </div>
      </div>

      <div class="edit-product-right">

        <div class="edit-product-title">
          <p class="font-weight-bold">Product Title</p>
          <input type="text" value="Davey Allison 28 Big Print" placeholder="Product Title">
          <i class="fas fa-edit edit-icon"></i>
        </div>

        <div class="edit-product-price">
          <p class="font-weight-bold">Price</p>
          <input type="text" value="P999.999" placeholder="Price">
          <i class="fas fa-edit edit-icon"></i>
        </div>

        <div class="edit-product-category">
          <p class="font-weight-bold">Category</p>
          <input type="text" value="Top" placeholder="Category">
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

</div>

<style>
  /* styles.css */

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

