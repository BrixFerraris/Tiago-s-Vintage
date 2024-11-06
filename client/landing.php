<?php
include 'header.php';
?>          

<link rel="stylesheet" href="../CSS/landing.css">
                        <div class="background">
                        <img class="bghaha" src="../assets/Component 2.png" alt="">
                            <h1 class="landing_text">Tiago's Vintage</h1>
                        </div>

    <div class="products">
        <p style="color: black;">NEW ARRIVALS</p>
            <div id="products" class="product-items">

            </div>
    </div>


<script>
    //Websocket connection
    var conn = new WebSocket('ws://localhost:8080/ws/');
    const productDiv = document.getElementById('products');
    conn.onopen = function() {
        conn.send(JSON.stringify({ type: 'loadProducts' }));
    };

    conn.onmessage = function(e) {
            var product = JSON.parse(e.data);
            console.log(product);
            if (product.type === 'product') {
                var newDiv = document.createElement('div');
                newDiv.innerHTML = `
                    <a href="./newItem.php?productID=${product.id}">
                        <img src="../server/includes/uploads/${product.img1}" alt="" width="252" height="320">
                    </a>
                `;
                productDiv.appendChild(newDiv);
            }
        };
        $(document).ready(function() {
            $.ajax({
                url: '../server/includes/getCMS.php', 
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        $('#cms-title').text('Error loading title');
                    } else {
                        $('.landing_text').text(data.landing_text);
                        $('.bghaha').attr('src', '../server/includes/uploads/'+data.landing_bg).show();
                    }
                },
                error: function() {
                    $('#cms-title').text('Error loading data');
                }
            });
        });
</script>

</body>
</html>

<?php
include '../test/newFooter.php';
?> 