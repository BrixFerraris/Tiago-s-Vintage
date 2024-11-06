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
    <div class="review-section">
      <div class="review">
        <h3>Juan Dela Cruz</h3>
        <div class="review-header">
          <span class="rating">★★★★★</span>
          <span class="date">09-12-2024</span>
          <span class="details">Color: White | Dimes: 32X30 | Size: Large</span>
        </div>
        <div class="review-body">
          <p><strong>Color:</strong> White</p>
          <p><strong>Appearance:</strong> Beautiful!</p>
          <p><strong>Material Quality:</strong> Original, High Quality</p>
          <p class="review-text">
            I recently bought this essential T-shirt, and I'm super impressed! The quality is fantastic—it's made from really soft cotton that feels great against the skin. Perfect for hot weather because it's lightweight and breathable. I've worn it all day, and it still feels comfortable and doesn't stick to my body.
          </p>
          <img src="../images/sample-item.png" alt="Product Image" class="review-image">
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
  
  body {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  background-color: #e6e8ed;
  color: #666666;
  font-family: "Montserrat", sans-serif;
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
  .review-body p{
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

.pagination .prev, .pagination .next {
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