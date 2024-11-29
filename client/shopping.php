<?php
include_once 'header.php';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

?>

<div class="sc">
    <h1>Shopping Cart</h1>
</div>

<div class="shopping-cart-container">
    <div class="cart-items">
        <?php
        $items = [
            ['image' => '../images/sample-item.png', 'name' => 'Carhartt Detroit Jacket (Tan) J97 288', 'size' => 'W25 x L25 (M)', 'condition' => 'Good', 'fit' => 'Boxy Fit', 'price' => 6500.00, 'quantity' => 1],
            ['image' => '../images/sample-item.png', 'name' => 'Carhartt Detroit Jacket (Tan) J97 288', 'size' => 'W25 x L25 (M)', 'condition' => 'Good', 'fit' => 'Boxy Fit', 'price' => 6500.00, 'quantity' => 1],
            ['image' => '../images/sample-item.png', 'name' => 'Carhartt Detroit Jacket (Tan) J97 288', 'size' => 'W25 x L25 (M)', 'condition' => 'Good', 'fit' => 'Boxy Fit', 'price' => 6500.00, 'quantity' => 1],
        ];

        $total = 0;

        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
            ?>
            <div class="cart-item">
                <div class="item-image">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                </div>
                <div class="item-details">
                    <p class="item-name"><?php echo $item['name']; ?></p>
                    <p>Size: <span><?php echo $item['size']; ?></span></p>
                    <p>Condition: <span><?php echo $item['condition']; ?></span></p>
                    <p>Fit: <span><?php echo $item['fit']; ?></span></p>
                    <p class="item-price">₱<?php echo number_format($item['price'], 2); ?></p>
                </div>
                <div class="item-quantity">
                    <button class="quantity-btn">-</button>
                    <span><?php echo $item['quantity']; ?></span>
                    <button class="quantity-btn">+</button>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="order-summary">
        <h2>Order Summary</h2>
        <p>Item(s) subtotal: <span>₱<?php echo number_format($total, 2); ?></span></p>
        <p><strong>Order Total</strong>: <span>₱<?php echo number_format($total, 2); ?></span></p>
        <button class="checkout-btn">Checkout</button>
    </div>
</div>

<?php
include_once 'footer.php';
?>

<style>
body {
    background-color: #f4f4f4;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

.sc {
    text-align: center;
    margin-top: 20px;
}

.sc h1 {
    font-weight: bold;
    text-transform: uppercase;
    font-size: 28px;
    letter-spacing: 2px;
    color: #333;
    margin-bottom: 30px;
}

.shopping-cart-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.cart-items {
    width: 65%;
    padding-right: 20px;
    border-right: 1px solid #ddd;
}

.cart-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #ddd;
}

.item-image img {
    width: 120px;
    height: auto;
    border-radius: 8px;
    border: 1px solid #ddd;
}

.item-details {
    margin-left: 20px;
    flex-grow: 1;
}

.item-name {
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.item-details p {
    margin: 4px 0;
    font-size: 14px;
    color: #666;
}

.item-details p span {
    font-weight: normal;
}

.item-price {
    font-size: 16px;
    color: #28a745;
    font-weight: bold;
    margin-top: 10px;
}

.item-quantity {
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity-btn {
    background-color: hsl(93, 100%, 20%);
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 4px;
    margin: 0 5px;
    transition: background-color 0.3s;
}

.quantity-btn:hover {
    background-color: #218838;
}

.order-summary {
    width: 30%;
    padding: 20px;
    border-radius: 8px;
    background-color: #fafafa;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.order-summary h2 {
    margin-bottom: 20px;
    font-size: 20px;
    color: #333;
}

.order-summary p {
    margin: 10px 0;
    font-size: 16px;
    color: #333;
}

.order-summary p span {
    font-weight: bold;
}

.checkout-btn {
    display: block;
    width: 100%;
    background-color: hsl(93, 100%, 20%);
    color: white;
    border: none;
    padding: 15px 0;
    cursor: pointer;
    font-size: 18px;
    text-transform: uppercase;
    border-radius: 4px;
    margin-top: 20px;
    transition: background-color 0.3s;
}

.checkout-btn:hover {
    background-color: #218838;
}

</style>