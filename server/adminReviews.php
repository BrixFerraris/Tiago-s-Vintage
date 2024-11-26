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
<script>
  $(document).ready(function () {
    // Function to fetch reviews
    function fetchReviews() {
      $.ajax({
        url: '../serverFunctions.php',
        type: 'GET',
        data: { action: 'getReviews' },
        dataType: 'json',
        success: function (data) {
          $('.review-section').empty();
          $.each(data, function (index, review) {
            console.log(review);
            
            const reviewHtml = `
                        <div class="review">
                            <h3>${review.username}</h3>
                            <div class="review-header">
                                <span class="rating">${'★'.repeat(review.rate)}${'☆'.repeat(5 - review.rate)}</span>
                                <span class="date">${review.date}</span>  
                            </div>
                            <div class="review-body">
                                <p><strong>Product:</strong> ${review.product_title}</p>
                                <p><strong>Variation:</strong> ${review.variation_name}</p>
                                <p class="review-text">${review.review}</p>
                                    ${review.img1 ? `<img src="../client/includes/uploads/${review.img1}" alt="Product Image" class="review-image">` : ''}
                                    ${review.img2 ? `<img src="../client/includes/uploads/${review.img2}" alt="Product Image" class="review-image">` : ''}
                                    ${review.img3 ? `<img src="../client/includes/uploads/${review.img3}" alt="Product Image" class="review-image">` : ''}
                            </div>
                            <div class="review-actions">
                                <button data-id="${review.id}" class="btn-show">Show</button>
                                <button data-id="${review.id}" class="btn-hide">Hide</button>
                            </div>
                        </div>
                    `;
            $('.review-section').append(reviewHtml);
            $('.review-section').on('click', '.btn-show', function () {
              const reviewId = $(this).data('id');
              $.ajax({
                url: '../serverFunctions.php',
                type: 'POST',
                data: {
                  type: 'updateReview',
                  id: reviewId,
                  visible: 'true'
                },
                dataType: 'json',
                success: function (response) {
                  if (response.error) {
                    console.error("Error updating review visibility: ", response.error);
                  } else {
                    fetchReviews(); // Refresh the reviews
                  }
                },
                error: function (xhr, status, error) {
                  console.error("Error updating review visibility: ", error);
                }
              });
            });

            // Separate event listener for the hide button
            $('.review-section').on('click', '.btn-hide', function () {
              const reviewId = $(this).data('id');
              $.ajax({
                url: '../serverFunctions.php',
                type: 'POST',
                data: {
                  type: 'updateReview',
                  id: reviewId,
                  visible: 'false'
                },
                dataType: 'json',
                success: function (response) {
                  if (response.error) {
                    console.error("Error updating review visibility: ", response.error);
                  } else {
                    fetchReviews(); // Refresh the reviews
                  }
                },
                error: function (xhr, status, error) {
                  console.error("Error updating review visibility: ", error);
                }
              });
            });
          });
        },
        error: function (xhr, status, error) {
          console.error("Error fetching reviews: ", error);
        }
      });
    }
    fetchReviews();
  });
</script>
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