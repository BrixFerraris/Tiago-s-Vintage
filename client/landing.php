<?php
include 'header.php';
?>          

<link rel="stylesheet" href="../CSS/landing.css">
                        <div class="background">
                            <img src="../assets/Component 2.png" alt="">
                            <h1 class="bgtxt">Tiago's Vintage</h1>
                        </div>

    <div class="products">
        <p>NEW ARRIVALS</p>
            <div id="products" class="product-items">

            </div>
    </div>
    </body>
</html>


<script>
    //Websocket connection
    var conn = new WebSocket('ws://65.19.154.77:6969/ws/');
    var productDiv =document.getElementById('products');
    conn.onopen = function() {
        conn.send(JSON.stringify({ type: 'loadProducts' }));
    };

    conn.onmessage = function(e) {
            var product = JSON.parse(e.data);
            if (product.type === 'product') {
                var newDiv = document.createElement('div');
                newDiv.innerHTML = `
                    <a href="#">
                        <img src="../server/includes/uploads/${product.img1}" alt="" width="252" height="320">
                    </a>
                `;
                productDiv.appendChild(newDiv);
            }
        };
</script>

</body>
</html>

<?php
include 'footer.php';
?> 