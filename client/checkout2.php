<?php
    session_start();
?>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.order-container {
    display: flex;
    background-color: #ffffff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

.order-items, .order-summary {
    padding: 20px;
    border-right: 1px solid #ddd;
}

.order-items {
    width: 60%;
    border-right: none;
}

.item {
    display: flex;
    align-items: center;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.item img {
    width: 80px;
    height: 80px;
    margin-right: 20px;
}

.details {
    flex-grow: 1;
}

.price {
    font-weight: bold;
    color: #333;
}

.total {
    text-align: right;
}

.total h3 {
    margin-top: 0;
}

.order-summary {
    width: 40%;
    background-color: #f7f7f7;
    border-left: 1px solid #ddd;
    display: flex;
    flex-direction: column;
}

.order-summary h3 {
    margin: 0;
    color: #555;
}

.order-summary p {
    margin: 5px 0;
}

.cancel-btn {
    margin-top: auto;
    padding: 10px;
    background-color: red;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}
.checkout-btn {
    margin-top: auto;
    padding: 10px;
    background-color: #28a745;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}
.btns{
    margin-top: auto;
    display:flex;
    justify-content: space-between;
}
.cancel-btn:hover {
    background-color: red;
}

</style>
<body>
    

    <div class="order-container">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['uID'] ;?>">
        <div class="order-items">
            <div class="item">
                <img src="https://via.placeholder.com/80" alt="Davey Allison 28 Big Print">
                <div class="details">
                    <h4>Davey Allison 28 Big Print</h4>
                    <p>25W X 35L (Large)</p>
                    <p>x1</p>
                </div>
                <div class="price">₱1500</div>
            </div>
            <div class="item">
                <img src="https://via.placeholder.com/80" alt="Essential Shirt">
                <div class="details">
                    <h4>Essential Shirt</h4>
                    <p>25W X 35L (Large)</p>
                    <p>x1</p>
                </div>
                <div class="price">₱1500</div>
            </div>
            <div class="item">
                <img src="https://via.placeholder.com/80" alt="Holy Spirit Kanye West Shirt">
                <div class="details">
                    <h4>Holy Spirit Kanye West Shirt</h4>
                    <p>25W X 35L (Large)</p>
                    <p>x1</p>
                </div>
                <div class="price">₱1500</div>
            </div>
            <div class="total">
                <h3>Order Total: ₱4500</h3>
            </div>
        </div>
        <div class="order-summary">
            <h3>Order Number</h3>
            <p>PO00001</p>
            <h3>Name</h3>
            <p id="name" >Juan Dela Cruz</p>
            <h3>Address</h3>
            <p>500 Villa nicasia 4 Bayan<br>
            Iuma 23 Imus Cavite, 4103</p>
            <h3>Contact No.</h3>
            <p id="contact">(+63) 9772954101</p>
            <div class="btns">
                <button class="checkout-btn">Check Out</button>
                <button class="cancel-btn">Cancel</button>
            </div>
        </div>

    </div>
</body>

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
                itemList += `<li> <img width="50px" height="50px" src="../server/includes/uploads/"${item.img1} alt="">${item.title} - ₱${item.price}</li>`;
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
                window.location.href='toPay.php?';
            }
        });
        });
</script>