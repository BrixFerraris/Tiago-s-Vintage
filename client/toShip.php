<?php
include './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Ship - Tiago's Vintage</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
      text-align: center;
    }

    .container {
      margin: 50px auto;
      max-width: 900px;
    }

    h1 {
      color: #2d6a4f;
      margin-bottom: 20px;
    }

    .order-list {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    .order-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #ddd;
      padding: 15px 0;
    }

    .order-details {
      display: flex;
      align-items: center;
    }

    .order-details img {
      width: 50px;
      height: 50px;
      border-radius: 5px;
      margin-right: 15px;
    }

    .order-description {
      text-align: left;
    }

    .order-description h3 {
      margin: 0;
      font-size: 16px;
      color: #333;
    }

    .order-description p {
      margin: 2px 0;
      font-size: 14px;
      color: #777;
    }

    .order-status {
      font-size: 14px;
      color: #40916c;
    }

    .shipping-info {
      font-size: 14px;
      color: #555;
    }

    .confirm-button {
      background-color: #40916c;
      color: white;
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }

    .track-button:hover {
      background-color: #2d6a4f;
    }

    .tabs {
      display: flex;
      justify-content: space-around;
      margin-bottom: 20px;
    }

    .tab-item {
      padding: 10px;
      cursor: pointer;
      font-size: 16px;
      color: #333;
    }

    .tab-item.active {
      font-weight: bold;
      color: white;
      background-color: #40916c;
      border-radius: 5px;
      padding: 10px 20px;
    }

  </style>
</head>
<body>

  <div class="container">
    <h1>My Orders - To Ship</h1>

    <!-- Tab Navigation -->
    <div class="tabs">
      <div class="tab-item">To Pay</div>
      <div class="tab-item active">To Ship</div>
      <div class="tab-item">To Receive</div>
      <div class="tab-item">Completed</div>
      <div class="tab-item">Cancelled</div>
    </div>

    <!-- Orders List -->
    <div class="order-list">
      <!-- First Order Item -->
      <div class="order-item">
        <div class="order-details">
          <img src="product-image.jpg" alt="Product Image">
          <div class="order-description">
            <h3>Davey Allison 28 Big Print</h3>
            <p>Size: 25W X 35L (Large)</p>
            <p>Quantity: 1</p>
          </div>
        </div>
        <div class="shipping-info">
          <p>Status: Packed</p>
        </div>
        <button class="confirm-button">Status</button>
      </div>

      <!-- Second Order Item -->
      <div class="order-item">
        <div class="order-details">
          <img src="product-image.jpg" alt="Product Image">
          <div class="order-description">
            <h3>Davey Allison 28 Big Print</h3>
            <p>Size: 25W X 35L (Large)</p>
            <p>Quantity: 1</p>
          </div>
        </div>
        <div class="shipping-info">
          <p>Status: Preparing</p>
        </div>
        <button class="confirm-button">Status</button>
      </div>
    </div>
  </div>

</body>
</html>
<?php
include_once 'footer.php';
?>
