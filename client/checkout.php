<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - Tiago's Vintage</title>
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
      max-width: 700px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    h1 {
      color: #2d6a4f;
      margin-bottom: 20px;
    }

    form {
      text-align: left;
      margin: 0 auto;
      max-width: 600px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-size: 14px;
      color: #333;
    }

    input[type="text"], input[type="email"], input[type="file"], select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    .btn {
      background-color: #40916c;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
      width: 100%;
    }

    .btn:hover {
      background-color: #2d6a4f;
    }

    .message {
      margin-top: 20px;
      color: green;
    }

  </style>
</head>
<body>
  <div class="container">
    <h1>Checkout - Tiago's Vintage</h1>

    <form action="process_checkout.php" method="POST" enctype="multipart/form-data">
      
      <!-- User Information -->
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="address">Shipping Address</label>
        <input type="text" id="address" name="address" required>
      </div>

      <!-- Payment Method -->
      <div class="form-group">
        <label for="payment-method">Payment Method</label>
        <select id="payment-method" name="payment-method" required>
          <option value="gcash">GCASH</option>
        </select>
      </div>

      <!-- Receipt Upload -->
      <div class="form-group">
        <label for="receipt-upload">Upload Payment Receipt</label>
        <input type="file" id="receipt-upload" name="receipt" accept="image/*" required>
      </div>

      <!-- Submit Button -->
      <button class="btn" type="submit" name="submit">Submit Order</button>
    </form>

    <?php
      if (isset($_GET['message'])) {
        echo "<p class='message'>" . htmlspecialchars($_GET['message']) . "</p>";
      }
    ?>
  </div>
</body>
</html>
