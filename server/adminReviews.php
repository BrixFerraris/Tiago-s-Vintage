<?php
session_start();

if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
  if ($role === 'Super Admin') {
    include_once './includes/sidebar.php';
  } else {
    header("location: adminDashboard.php");
    exit();
  }
} else {
  header("location: ../landing.php?error=NotLoggedIn");
  exit();
}
?>

<!-- Main -->
<main class="main-container">
  <div class="main-title">
    <p class="font-weight-bold">REVIEWS</p>
  </div>

  <div class="content">
    <div class="form-group sort">
      <label for="sort">Sort</label>
      <div class="sort">
        <select id="sort" name="sort" required>

          <option value="all">All</option>
          <option value="visible">Visible</option>
          <option value="hiddem">Hidden</option>

        </select>
      </div>
      <!-- Review Section -->
      <div class="review-section">
        <div class="review">
        <h3>Juan Dela Cruz</h3>
          <div class="review-header">
            <span class="rating">★★★★★</span>
            <span class="date">09-12-2024</span>  
          </div>
          <div class="review-body">
            <p><strong>Product:</strong> Nike Shirt</p>
            <p><strong>Variation:</strong> White (29x24)</p>
            <p class="review-text">
              I recently bought this essential T-shirt, and I'm super impressed! The quality is fantastic—it's made from
              really soft cotton that feels great against the skin. Perfect for hot weather because it's lightweight and
              breathable. I've worn it all day, and it still feels comfortable and doesn't stick to my body.
            </p>
            <img src="../images/sample-item.png" alt="Product Image" class="review-image">
            <img src="../images/sample-item.png" alt="Product Image" class="review-image">
            <img src="../images/sample-item.png" alt="Product Image" class="review-image">
          </div>
          <div class="review-actions">
            <button class="btn-show">Show</button>
            <button class="btn-hide">Hide</button>
          </div>
        </div>
        <!-- Duplicate the review div for additional reviews -->
      </div>

      <!-- Pagination -->
      <div class="pagination">
        <a href="#" class="prev">Previous</a>
        <a href="#" class="page-num">1</a>
        <a href="#" class="page-num">2</a>
        <a href="#" class="page-num">...</a>
        <a href="#" class="next">Next</a>
      </div>
    </div>
</main>
<!-- End Main -->

<style>
  /* reviews */
  .review-section {
    margin: 20px 0;
  }

  .review {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 20px;
  }

  .review-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
  }

  .rating {
    color: #f0c14b;
  }

  .review-body {
    margin-bottom: 10px;
  }

  .review-image {
    width: 100px;
    height: auto;
    margin-top: 10px;
  }

  .review-actions {
    text-align: right;
  }

  /* buttons */
  .btn-show,
  .btn-hide {
    padding: 10px 20px;
    /* Adjusted padding for larger buttons */
    margin: 0 10px;
    /* Spacing between buttons */
    border: none;
    /* Remove border for a cleaner look */
    border-radius: 5px;
    /* Rounded corners */
    color: white;
    /* White text color */
    font-weight: bold;
    /* Bold text */
    cursor: pointer;
  }

  .btn-show {
    background-color: rgb(76, 175, 80);
    /* Green background for the "Edit" button */
  }

  .btn-hide {
    background-color: rgb(244, 67, 54);
    /* Red background for the "Delete" button */
  }

  /* sort */
  #sort {
    width: 100px;
  }
</style>

<script>
  // JavaScript for Show/Hide functionality
  const showButtons = document.querySelectorAll('.btn-show');
  const hideButtons = document.querySelectorAll('.btn-hide');

  showButtons.forEach(button => {
    button.addEventListener('click', () => {
      const reviewBody = button.closest('.review').querySelector('.review-body');
      reviewBody.style.display = 'block';
    });
  });

  hideButtons.forEach(button => {
    button.addEventListener('click', () => {
      const reviewBody = button.closest('.review').querySelector('.review-body');
      reviewBody.style.display = 'none';
    });
  });
</script>
<script src="../test/sidebarToggle.js"></script>
