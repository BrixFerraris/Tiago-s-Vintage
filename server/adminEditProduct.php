<?php
  include_once './includes/sidebar.php';
?>

<!-- Main -->
<main class="main-container">
  <link rel="stylesheet" href="../CSS/adminEditProduct.css">
  <div class="main-title">
    <p class="font-weight-bold">Edit Products</p>
  </div>

  <!-- edit products -->
  <!-- input code here -->

  <div class="edit-product">
    <div class="edit-product-left">
      <p class="font-weight-bold">Variations:</p>
      
      <div class="variations">
        <div class="edit-product-variation">
          <label for="name">Name:</label>
          <input type="text" id="name" value="White" readonly="readonly">
        </div>

        <div class="edit-product-variation">
          <label for="width">Width:</label>
          <input type="text" id="width" value="24" readonly="readonly">
        </div>

        <div class="edit-product-variation">
          <label for="length">Length:</label>
          <input type="text" id="length" value="29" readonly="readonly">
        </div>

        <div class="edit-product-variation">
          <label for="quantity">Quantity:</label>
          <div class="quantity-control">
            <input type="number" id="quantity" value="3" readonly="readonly">
          </div>
        </div>

        <div class="edit-product-variation">
          <span class="material-icons-outlined edit-iconn"> edit </span>
        </div>
      </div>

      <p class="font-weight-bold">New Variation:</p>
      <div class="edit-product-variations">
        <div class="edit-product-variation">
          <label for="name">Name:</label>
          <input type="text" id="name" value="">
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

        <div class="edit-product-variation">
          <label for="imgVar">Image</label>
          <input type="file" id="imgVar" name="imgVar" accept="image/*" required>
        </div>
      </div>
      <div class="add-variation-btn">
        <button class="add-variation">Add Variation</button>
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
</main>

<!-- Modal Structure -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Edit Variation Details</h2>
  <div class="modal-var">

  
    <div class="edit-variation">
      <label for="modal-name">Name:</label>
      <input type="text" id="modal-name" value="White">
    </div>
      
    <div class="edit-variation">
      <label for="modal-width">Width:</label>
      <input type="number" id="modal-width" value="24">
    </div>
      
    <div class="edit-variation">
      <label for="modal-length">Length:</label>
      <input type="number" id="modal-length" value="29">
    </div>

    <div class="edit-variation">
      <label for="modal-quantity">Quantity:</label>
      <input type="number" id="modal-quantity" value="3">
    </div>

    <button class="save-modal">Save Changes</button>
  </div>
</div>
</div>


<style>

</style>

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

// MODAL LOGIC
const modal = document.getElementById("editModal");
const editIcons = document.querySelectorAll(".edit-iconn");
const span = document.getElementsByClassName("close")[0];

// When the user clicks the edit icon, open the modal
editIcons.forEach(icon => {
  icon.onclick = function() {
    modal.style.display = "block";
  };
});

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
</script>
</body>
</html>
