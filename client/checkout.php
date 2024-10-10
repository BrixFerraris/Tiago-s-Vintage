<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../CSS/checkout.css"> 
</head>
<body>
<?php
    session_start();
?>
    <div class="checkout-container">
<input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['uID'] ;?>">
        <!-- Order Summary -->
        <div class="order-summary">
            <h2>Order Summary</h2>
            <ul>  
                    <li></li>
            </ul>
            <p><strong>Total: ₱</strong></p>
        </div>

        <!-- Shipping Info -->
        <div class="shipping-info">
            <h2>Shipping Information</h2>
                <label for="name">Full Name</label>
                <input type="text" readonly="readonly" id="name" name="name" placeholder="Enter your full name" required>
                
                <label for="address">Shipping Address</label>
                <input type="text" id="address" name="address" placeholder="Enter your shipping address" required>
                
                <label for="contact">Contact Number</label>
                <input type="text" readonly="readonly" id="contact" name="contact" placeholder="Enter your contact number" required>
                
                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="submit" id="place-order" class="place-order">Place Order</button>
                    <button type="button" class="cancel-order" onclick="window.location.href='shopcart.php';">Cancel</button>
                </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){

            //Websocket connection
            var conn = new WebSocket('ws://localhost:8080');
            const url = new URL(window.location.href);
            const userID = url.searchParams.get('userID');
            var uID =  document.getElementById('user_id').value;
            if (userID != uID) {
                window.location.href = "./checkout.php?uID="+uID;
                userID =uID;
            }
            conn.onopen = function(e) {
                conn.send(JSON.stringify({ type: 'loadCart', user_id: userID }));
            };
            conn.onmessage = function(e) {
                try {
                    var orderSummary = JSON.parse(e.data);
                    console.log(orderSummary);
                    var name =document.getElementById('name');
                    var contact = document.getElementById('contact');
                    
                    var itemList = '';
                    orderSummary.forEach(function(item) {
                    itemList += `<li>${item.title} - ₱${item.price}</li>`;
                    name.value = item.firstName+' '+item.lastName;
                    contact.value = item.contact;
                    });
                    
                    document.querySelector('.order-summary ul').innerHTML = itemList;
                    
                    var total = 0;
                    orderSummary.forEach(function(item) {
                    total += item.total;
                    });
                    
                    document.querySelector('.order-summary strong').textContent = `Total: ₱${total}`;
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            };
            document.addEventListener('click', function(e){
                if (e.target.classList.contains('place-order')) {
                    var address = document.getElementById('address').value;
                    conn.send(JSON.stringify({ type: 'order', user_id: userID, address: address }));
                    alert('Order placed successfully!');
                    window.location.href='landing.php';
                }
            });
        });

    </script>

</body>
</html>