<?php

include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<title>Tiago's Vintage</title>

</head>


<!-- Main -->
<main class="main-container">
  <div class="content">

    <!-- Review Section -->
    <div class="review-section" id="reviews-container">
      <!-- Reviews will be dynamically injected here -->
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
    function fetchReviews() {
      $.ajax({
        url: '../serverFunctions.php',
        type: 'GET',
        data: {
          action: 'getReviews'
        },
        dataType: 'json',
        success: function (response) {
          response.forEach(function (review) {
            if (review.visible == "true") {
              $('#reviews-container').empty();
              const reviewHtml = `
                            <div class="review">
                                <h3>${review.username}</h3>
                                <div class="review-header">
                                    <span class="rating">${'★'.repeat(review.rating)}</span>
                                    <span class="date">${review.date}</span>
                                </div>
                                <div class="review-body">
                                    <p><strong>Product:</strong> ${review.product_title}</p>
                                    <p><strong>Variation:</strong> ${review.variation_name}</p>
                                    <p class="review-text">${review.review}</p>
                                      ${review.img1 ? `<img src="./includes/uploads/${review.img1}" alt="Product Image" class="review-image">` : ''}
                                      ${review.img2 ? `<img src="./includes/uploads/${review.img2}" alt="Product Image" class="review-image">` : ''}
                                      ${review.img3 ? `<img src="./includes/uploads/${review.img3}" alt="Product Image" class="review-image">` : ''}
                                </div>
                            </div>
                        `;
              $('#reviews-container').append(reviewHtml);
            } else {
              response.forEach(function (review) {
                const reviewHtml = `
                            <div class="review">
                                <h3>NO REVIEWS YET</h3>
                            </div>
                        `;
                $('#reviews-container').append(reviewHtml);
              });
            }
          });

        },
        error: function (xhr, status, error) {
          $('#reviews-container').html('<p>Error fetching reviews: ' + error + '</p>');
        }
      });
    }

    // Fetch reviews on page load
    fetchReviews();
  });
</script>

<style>
  body {
    background-color: #e6e8ed;

  }

  .main-container {
    grid-area: main;
    overflow-y: auto;
    padding: 20px 20px;
  }

  .content {
    flex-grow: 1;
    padding: 20px;
    background-color: #f9f9f9;
  }

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

  .review-body p {
    color: black;
  }

  .review-image {
    width: 100px;
    height: auto;
    margin-top: 10px;
  }


  /* Pagination */
  .pagination {
    display: flex;
    justify-content: flex-start;
    gap: 8px;
    margin-top: 20px;
  }

  .pagination a {
    text-decoration: none;
    color: #333;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: background-color 0.3s;
  }

  .pagination a:hover {
    background-color: #ddd;
  }

  .pagination .prev,
  .pagination .next {
    font-weight: 600;
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



</html>

<?php

include '../test/newFooter.php';
?>