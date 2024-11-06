<?php
include 'header.php';
$isLoggedIn = false;
if (isset($_SESSION["uID"])) {
$isLoggedIn = true;
}
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
                <p>Subtotal:</p>
                <!-- <button class="btnCancel">CONTINUE SHOPPING</button> -->
            </div>
            
        </div>
<script>
var isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
if (!isLoggedIn) {
    alert("Please log in to view your shopping cart.");
    window.location.href = "./login.php";
}
var maxQty = 0;
var current_Qty = 0;
var subtotal = 0;
var price = 0;
document.addEventListener('DOMContentLoaded', function(){
    // Websocket connection
    var conn = new WebSocket('ws://localhost:8080/ws/');
    var user_id = document.getElementById('user_id').value;
    console.log(user_id);
    conn.onopen = function(e) {
        conn.send(JSON.stringify({ type: 'loadCart', user_id: user_id}));
    };
    conn.onmessage = function(e) {
        var cart = JSON.parse(e.data);
        // console.log(cart);
        var cartItemsContainer = document.querySelector('.cart-items');
        cartItemsContainer.innerHTML = ''; 

        cart.forEach(function(item) {
            var cartItemHtml = `
                <div class="cart-purchase">
                    <div class="cart-image">
                        <img src="../server/includes/uploads/${item.img1}" alt="${item.title} image">
                    </div>
                    <div class="item-info">
                        <h2>${item.title}</h2>
                        <p>${item.variationName}</p>
                        <p>₱${item.price}</p>
                    </div>
                    <div class="item-quantity">
                <div class="incdec">
                            <button class="btnMinus" data-item-id="${item.id}">-</button>
                            <input type="hidden" value="${item.transactionId}" id="transID">
                            <input type="text" class="qnty" max="${item.variantQuantity}" value="${item.quantity}" id="quantity_${item.id}" readonly>
                            <button class="btnPlus" data-item-id="${item.id}">+</button>
                            <div class="btnremove">
                                <button class="btnRemove btn-remove" data-id="${item.transactionId}">Remove</button>
                            </div>
                        </div>

                    <!-- Remove Button -->
                    
                </div>
                </div>
            `;
            cartItemsContainer.insertAdjacentHTML('beforeend', cartItemHtml);
            price = item.price;
            maxQty = item.variantQuantity;
            current_Qty = item.quantity;
            subtotal += price * current_Qty;

        });
        var transID = document.getElementById('transID').getAttribute('value');
        var subtotalHtml = `
    <p id="subtotal">Subtotal: ₱${subtotal}</p>
    <button data-id="${transID}" class="btnCheckout">CHECKOUT</button>
`;
    document.querySelector('.item-total').innerHTML = subtotalHtml;
    document.querySelector('.item-total').innerHTML = subtotalHtml;

};

    document.addEventListener('click', function(e){
        if (e.target.classList.contains('btnCheckout')) {
            window.location.href = 'checkout.php?userID='+user_id;
            var transactionID = e.target.getAttribute('data-id');
            conn.send(JSON.stringify({ type: 'checkOut', quantity: current_Qty, total: subtotal, transactionID: transactionID}));
        }
        if (e.target.classList.contains('btn-remove')) {
            var itemId = e.target.getAttribute('data-id');
            conn.send(JSON.stringify({ type: 'removeCart', transactionID: itemId}));
            alert('Removed item from cart');
            window.location.reload();
        }
    });
});

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btnPlus')) {
            var itemId = e.target.getAttribute('data-item-id');
            var quantityInput = document.getElementById('quantity_' + itemId);
            var currentValue = parseInt(quantityInput.value, 10);
            var subtotalText = document.getElementById('subtotal');
            if (currentValue < maxQty ) {
                currentValue++;
                quantityInput.value = currentValue;
                current_Qty = currentValue;
                subtotal = price * currentValue;
                subtotalText.innerText = "Subtotal: ₱"+subtotal;
            }
        }

        if (e.target.classList.contains('btnMinus')) {
            var itemId = e.target.getAttribute('data-item-id');
            var quantityInput = document.getElementById('quantity_' + itemId);
            var currentValue = parseInt(quantityInput.value, 10);
            var subtotalText = document.getElementById('subtotal');
            if (currentValue > 1) {
                currentValue--;
                quantityInput.value = currentValue;
                current_Qty = currentValue;
                subtotal = price * currentValue;
                subtotalText.innerText = "Subtotal: ₱"+subtotal;
            }
        }
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

.item-info h2,p {
color: black;
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
    color: black;
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
.btnremove{
    margin-left: 20px;
}

</style>
