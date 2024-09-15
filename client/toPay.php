<?php
include './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Orders - To Pay</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 90%;
      margin: 20px auto;
      max-width: 1200px;
    }

    .tabs {
      display: flex;
      justify-content: space-around;
      margin-bottom: 20px;
    }

    .tab-item {
      padding: 15px;
      cursor: pointer;
      font-size: 16px;
      text-align: center;
      width: 100%;
      color: #333;
      border-bottom: 2px solid transparent;
    }

    .tab-item.active {
      font-weight: bold;
      color: white;
      background-color: #40916c;
      border-bottom: 2px solid #40916c;
      border-radius: 5px 5px 0 0;
    }

    .order-card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .order-card img {
      width: 80px;
      height: 80px;
      border-radius: 10px;
    }

    .order-details {
      flex-grow: 1;
      margin-left: 20px;
    }

    .order-details h3 {
      font-size: 18px;
      margin: 0;
      color: #333;
    }

    .order-details p {
      font-size: 14px;
      color: #777;
      margin: 5px 0;
    }

    .order-price {
      font-size: 18px;
      color: #333;
      font-weight: bold;
      margin-right: 20px;
    }

    .pay-button {
      background-color: #ff6b6b;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s;
    }

    .pay-button:hover {
      background-color: #ff4c4c;
    }
    
    .status-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #40916c;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .status-icon img {
      width: 15px;
      height: 15px;
      margin-right: 5px;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>My Orders - To Pay</h1>

    <!-- Tab Navigation -->
    <div class="tabs">
      <div class="tab-item active">To Pay</div>
      <div class="tab-item">To Ship</div>
      <div class="tab-item">To Receive</div>
      <div class="tab-item">Completed</div>
      <div class="tab-item">Cancelled</div>
    </div>

    <!-- Orders List -->
    <div class="order-card">
      <div class="order-details">
        <h3>Davey Allison 28 Big Print</h3>
        <p>Size: 25W X 35L (Large)</p>
        <p>Quantity: 1</p>
      </div>
      <div class="order-price">₱1500</div>
      <button class="pay-button">Pay Now</button>
    </div>

    <div class="order-card">
      <div class="order-details">
        <h3>Davey Allison 28 Big Print</h3>
        <p>Size: 25W X 35L (Large)</p>
        <p>Quantity: 1</p>
      </div>
      <div class="order-price">₱1500</div>
      <button class="pay-button">Pay Now</button>
    </div>

  </div>

</body>
</html>


