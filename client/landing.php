<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://fonts.cdnfonts.com/css/koulen" rel="stylesheet">
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
                <link rel="icon" href="../assets/icons.ico" type="image/x-icon">
                <link rel="stylesheet" href="../CSS/landing.css">
                
            <title>Tiago's Vintage Boutique</title>
        </head>
        <body>
            
    
        </body>
    </html>

<div clas="container">
                        <nav class ="topnav">
                            <label class="title">Tiago's Vintage</label>
                            <img class="logo" src="../assets/tiagos-removebg-preview 1.png" alt="">
                                <ul>
                                    <li><a href="">Home</a></li>
                                    <li><a href="">New arrivals</a></li>
                                    <li><a href="">Tops</a></li>
                                    <li><a href="">Bottom</a></li>
                                    <li><a href="">Shoes</a></li>
                                    <li><a href="">Accessories</a></li>
                                    <li><a href="">Reviews</a></li>
                                    <li><img class="search" src="../assets/Search.png" alt=""></li>
                                    <li><img class="shopping" src="../assets/Shopping Cart.png" alt=""></li>
                                    <li><a href="./register.php">Register/Login</a></li>
                                </ul>
                        </nav>
                        
                        <div class="background">
                            <img src="../assets/Component 2.png" alt="">
                        </div>

                        <div class="products">
    <p>PRODUCTS</p>
    <div class="product-items">
        <div>
            <a href="#">
                <img src="../assets/tshirt.png" alt="" width="252" height="320">
            </a>
        </div>
        <div>
            <a href="#">
                <img src="../assets/tshirt2.png" alt="" width="252" height="320">
            </a>
        </div>
        <div>
            <a href="#">
                <img src="../assets/tshirt3.png" alt="" width="252" height="320">
            </a>
        </div>
        <div>
            <a href="#">
                <img src="../assets/pants.png" alt="" width="252" height="320">
            </a>
        </div>
        <div>
            <a href="#">
                <img src="../assets/tshirt4.png" alt="" width="252" height="320">
            </a>
        </div>
        <div>
            <a href="#">
                <img src="../assets/tshirt5.png" alt="" width="252" height="320">
            </a>
        </div>
        <div>
            <a href="#">
                <img src="../assets/pants2.png" alt="" width="252" height="320">
            </a>
        </div>
        <div>
            <a href="#">
                <img src="../assets/tshirt6.png" alt="" width="252" height="320">
            </a>
        </div>
        <div>
            <a href="#">
                <img src="../assets/sleeve.png" alt="" width="252" height="320">
            </a>
        </div>
        <div>
            <a href="#">
                <img src="../assets/tshirt7.png" alt="" width="252" height="320">
            </a>
        </div>
        <div>
            <a href="#">
                <img src="../assets/jorts.png" alt="" width="252" height="320">
            </a>
        </div>
        <div>
            <a href="#">
                <img src="../assets/tshirt8.png" alt="" width="252" height="320">
            </a>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>
             </div>

    <script>
        let slides = document.querySelectorAll('.slide');
        let currentIndex = 0;
        let slideInterval = 5000; // 5 seconds

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('in');
                if (i === index) {
                    slide.classList.add('in');
                }
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        showSlide(currentIndex); // Show the first slide initially
        setInterval(nextSlide, slideInterval); // Change slide every 5 seconds
    </script>

</body>
</html>
