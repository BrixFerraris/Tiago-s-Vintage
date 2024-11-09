<?php
include './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment - Tiago's Vintage</title>
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
      max-width: 600px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    h1 {
      color: #2d6a4f;
      margin-bottom: 20px;
    }

    .qr-section, .receipt-section {
      display: inline-block;
      vertical-align: top;
      width: 45%;
      margin: 0 10px;
    }

    .qr-section {
      text-align: center;
      padding: 20px;
      border: 2px solid #2d6a4f;
      border-radius: 10px;
    }

    .qr-section img {
      width: 150px;
      margin-bottom: 10px;
    }

    .qr-section p {
      font-size: 18px;
      margin: 0;
      font-weight: bold;
      color: #2d6a4f;
    }

    .receipt-section {
      padding: 20px;
      border: 2px dashed #2d6a4f;
      border-radius: 10px;
      text-align: center;
    }

    .receipt-section input[type="file"] {
      display: none;
    }

    .receipt-section label {
      cursor: pointer;
      padding: 10px;
      background-color: #95d5b2;
      color: white;
      border-radius: 5px;
      display: inline-block;
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
    <h1>Tiago's Vintage Payment</h1>

    <div class="qr-section">
      <img src="qr-code-image.png" alt="GCASH QR Code">
      <p>A********R C****</p>
      <p>GCASH</p>
    </div>

    <div class="receipt-section">
      <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="receipt-upload">Select Image</label>
        <input type="file" id="receipt-upload" name="receipt" accept="image/*">
        <br><br>
        <button class="btn" type="submit" name="submit">Submit</button>
      </form>
    </div>
    
    <?php
      if (isset($_GET['message'])) {
        echo "<p class='message'>" . htmlspecialchars($_GET['message']) . "</p>";
      }
    ?>
  </div>
</body>
</html>
<?php
include '../test/newFooter.php';
?> 