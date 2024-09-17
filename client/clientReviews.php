<?php
include './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reviews</title>
    <link rel="stylesheet" href="../CSS/clientReviews.css">
</head>
<body>

<div class="reviews-container">
    <h1>REVIEWS</h1>
    
    <!-- Sort Options -->
    <div class="sort">
        <label for="sort-options">Sort:</label>
        <select id="sort-options" onchange="filterReviews()">
            <option value="all">All</option>
            <option value="rating">Rating</option>
            <option value="date">Date</option>
        </select>
    </div>
    
    <div class="review-section">
      <div class="review">
        <h3>Juan Dela Cruz</h3>
        <div class="review-header">
          <span class="rating">★★★★★</span>
        </div>
        <div class="review-body">
          <span class="details">Color: White | Dimes: 32X30 | Size: Large</span>
          <p><strong>Appearance:</strong> Beautiful!</p>
          <p><strong>Material Quality:</strong> Original, High Quality</p>
          <p class="review-text">
            I recently bought this essential T-shirt, and I'm super impressed! The quality is fantastic—it's made from really soft cotton that feels great against the skin. Perfect for hot weather because it's lightweight and breathable. I've worn it all day, and it still feels comfortable and doesn't stick to my body.
          </p>
          <img src="../images/sample-item.png" alt="Product Image" class="review-image">
        </div>
        <div class="review-actions">
          <button class="btn-show">Show</button>
        </div>
      </div>

</div>

<script src="script.js"></script>

</body>
</html>
