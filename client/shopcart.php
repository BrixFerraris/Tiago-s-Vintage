<?php
include 'header.php';
?>

      
<div class="cart-container">
            <div class="cart-text">
                <h2>Your Shopping Cart</h2>
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION["uID"];?>">
            </div>
            
            <!-- Cart Items -->
            <div class="cart-items">
                <!-- First Item -->
                <div class="cart-purchase">
                    <div class="cart-image">
                        <img src="../assets/tshirt4.png" alt="T-shirt image">
                    </div>
                    <div class="item-info">
                        <h2>Davey Allison 28 Big Print</h2>
                        <p>25W X 35L (Large)</p>
                        <p>₱1500</p>

                    </div>
                </div>
                
            </div>
            <div class="item-total">
                <p>Subtotal: ₱4500</p>
                <!-- <button class="btnCancel">CONTINUE SHOPPING</button> -->
            </div>
        </div>
        <script>
document.addEventListener('DOMContentLoaded', function(){
    // Websocket connection
    var conn = new WebSocket('ws://localhost:8080');
    var user_id = document.getElementById('user_id').value;
    console.log(user_id);
    conn.onopen = function(e) {
        conn.send(JSON.stringify({ type: 'loadCart', user_id: user_id}));
    };
    conn.onmessage = function(e) {
        var cart = JSON.parse(e.data);
        console.log(cart);
        var subtotal = 0;
        var cartItemsContainer = document.querySelector('.cart-items');
        cartItemsContainer.innerHTML = ''; 
        cart.forEach(function(item) {
            var cartItemHtml = `
                <div class="cart-purchase">
                    <div class="cart-image">
                        <img src="../server/includes/uploads/${item.img1}" alt="${item.name} image">
                    </div>
                    <div class="item-info">
                        <h2>${item.title}</h2>
                        <p>${item.size}</p>
                        <p>₱${item.price}</p>
                    </div>
                </div>
            `;
            cartItemsContainer.insertAdjacentHTML('beforeend', cartItemHtml);
            subtotal += item.price * item.quantity;
        });
        var subtotalHtml = `
    <p>Subtotal: ₱${subtotal}</p>
    <button class="btnCheckout">CHECKOUT</button>
`;
document.querySelector('.item-total').innerHTML = subtotalHtml;
        document.querySelector('.item-total').innerHTML = subtotalHtml;
    };

    document.addEventListener('click', function(e){
    if (e.target.classList.contains('btnCheckout')) {
        window.location.href = 'checkout.php?userID='+user_id;
    }
});
});
        </script>
<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background-color: #f9f9f9;
}

.cart-text {
    margin-top: 50px;
    text-align: center;
}

.cart-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.cart-items {
    margin: 20px 0;
}

.cart-purchase {
    display: flex;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0; 
}

.cart-image img {
    width: 80px;
}

.item-info {
    flex: 2;
    padding-left: 20px;
}

.item-info h2 {
    font-size: 18px;
    margin-bottom: 5px;
}

.item-quantity {
    display: flex;
    flex-direction: column;
    align-items: flex-end; /* Align the quantity on the right */
}

.incdec {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.incdec input {
    width: 40px;
    text-align: center;
    margin: 0 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.incdec button {
    background-color: #eaeaea;
    border: 1px solid #ccc;
    padding: 5px 10px;
    font-size: 16px;
    cursor: pointer;
}

.item-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.item-total p {
    font-size: 18px;
    font-weight: bold;
}

.btnCheckout, .btnCancel {
    padding: 10px 20px;
    background-color: green;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btnCancel {
    background-color: #ccc;
}
</style>
