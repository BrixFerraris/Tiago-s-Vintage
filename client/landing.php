<?php
include 'header.php';
?>          
                        <div class="background">
                            <img src="../assets/Component 2.png" alt="">
                        </div>
    <div class="products">
        <p>PRODUCTS</p>
            <div id="products" class="product-items">

            </div>
    </div>
    </body>
</html>


<script>
    //Websocket connection
    var conn = new WebSocket('ws://localhost:8080');
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