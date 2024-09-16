<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../CSS/checkout.css"> 
</head>
<body>

    <div class="checkout-container">
        <!-- PHP Logic to Fetch the Cart Data -->
        <?php
            // This is a dummy data structure. Replace it with a database fetch or session cart system.
            $orderItems = [
                ["name" => "Davey Allison 28 Big Print", "size" => "Large", "price" => 1500],
                ["name" => "Essential Shirt", "size" => "Large", "price" => 1500],
                ["name" => "Holy Spirit Kanye West Shirt", "size" => "Large", "price" => 1500]
            ];

            $totalPrice = 0;
            foreach ($orderItems as $item) {
                $totalPrice += $item['price'];
            }
        ?>

        <!-- Order Summary -->
        <div class="order-summary">
            <h2>Order Summary</h2>
            <ul>
                <?php foreach ($orderItems as $item): ?>
                    <li><?php echo $item['name']; ?> (<?php echo $item['size']; ?>) - ₱<?php echo number_format($item['price'], 2); ?></li>
                <?php endforeach; ?>
            </ul>
            <p><strong>Total: ₱<?php echo number_format($totalPrice, 2); ?></strong></p>
        </div>

        <!-- Shipping Info -->
        <div class="shipping-info">
            <h2>Shipping Information</h2>
            <form method="POST" action="process_order.php"> <!-- Action to handle the form submission -->
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                
                <label for="address">Shipping Address</label>
                <input type="text" id="address" name="address" placeholder="Enter your shipping address" required>
                
                <label for="contact">Contact Number</label>
                <input type="text" id="contact" name="contact" placeholder="Enter your contact number" required>
                
                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="submit" class="place-order">Place Order</button>
                    <button type="button" class="cancel-order" onclick="window.location.href='cart.php';">Cancel</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
