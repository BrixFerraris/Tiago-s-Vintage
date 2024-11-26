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
<section class="py-5">
    <div class="container">
        <div class="row gx-4 align-items-center justify-content-between">
            <div class="col-md-5 order-2 order-md-1">
                <div class="mt-5 mt-md-0">
                    <span class="text-muted" style="color:black; cursor:default;">Tiago's Vintage Boutique</span>
                    <h2 class="display-5 fw-bold" style="color:black; cursor:default;">About Us</h2>
                    <p class="lead" id="about-us-info" style="color:black; cursor:default;">Tiago's Vintage Boutique,
                        founded by Tiago, began as a small shoe business but transformed into a vintage clothing haven.
                        Located at #547 Bayan Luma 5, Imus, Cavite, the boutique offers a carefully curated selection of
                        nostalgic workwear, streetwear, and branded items like Supreme and Carhartt. <br> Despite
                        challenges during the pandemic, Tiago's passion for unique vintage fashion led to the boutique's
                        growth. Now, with both physical and online stores, Tiago’s enhances the customer experience
                        through a cloud-based inventory system, offering real-time updates and personalized service to
                        vintage enthusiasts..</p>
                    <p class="lead" style="color:black; cursor:default;">"Where timeless fashion meets modern style –
                        discover your unique vintage at Tiago's."</p>
                </div>
            </div>
            <div class="col-md-6 offset-md-1 order-1 order-md-2">
                <div class="row gx-2 gx-lg-3">
                    <div class="col-6">
                        <div class="mb-2"><img class="img-fluid rounded-3" src="../images/About-us picture.jpg"></div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2"><img class="img-fluid rounded-3" src="../images/About-us picture.jpg"></div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2"><img class="img-fluid rounded-3" src="../images/About-us picture.jpg"></div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2"><img class="img-fluid rounded-3" src="../images/About-us picture.jpg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    //Websocket connection
    var conn = new WebSocket('ws://localhost:8080/ws/');
    const productDiv = document.getElementById('products');
    conn.onopen = function () {
        conn.send(JSON.stringify({ type: 'loadProducts' }));
    };

    conn.onmessage = function (e) {
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
    $(document).ready(function () {
        $.ajax({
            url: '../server/includes/getCMS.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.error) {
                    $('#cms-title').text('Error loading title');
                } else {
                    $('.landing_text').text(data.landing_text);
                    $('.bghaha').attr('src', '../server/includes/uploads/' + data.landing_bg).show();
                }
            },
            error: function () {
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