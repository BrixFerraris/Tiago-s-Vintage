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

    <div clas="container">
                        <nav class ="topnav">
                            <label class="title">Tiago's Vintage</label>
                            <img class="logo" src="../assets/tiagos-removebg-preview 1.png" alt="">
                                <ul>
                                    <?php
                                    session_start();
                                    if (isset($_SESSION["username"])) {
                                        echo '<li><a href="../client/landing.php">Home</a></li>';
                                        // echo '<li><a href="../client/productList.php">New arrivals</a></li>';
                                        echo '<li><a href="../client/productList.php">All products</a></li>';
                                        echo '<li><a href="../client/productList.php?category=Tops">Tops</a></li>';
                                        echo '<li><a href="../client/productList.php?category=Bottom">Bottom</a></li>';
                                        echo '<li><a href="../client/productList.php?category=Shoes">Shoes</a></li>';
                                        echo '<li><a href="../client/productList.php?category=Accessories">Accessories</a></li>';
                                        echo '<li><a href="../client/reviews.php">Reviews</a></li>';
                                        echo '<li><img class="search" src="../assets/Search.png" alt=""></li>';
                                        echo '<li><a href="../client/shopcart.php"><img class="shopping" src="../assets/Shopping Cart.png" alt=""></a></li>';
                                        echo '<li><a href="./includes/logout.php">Log Out</a></li>';
                                    } else {
                                      echo '<li><a href="../client/landing.php">Home</a></li>';
                                      // echo '<li><a href="../client/productList.php">New arrivals</a></li>';
                                      echo '<li><a href="../client/productList.php">Tops</a></li>';
                                      echo '<li><a href="../client/productList.php">Bottom</a></li>';
                                      echo '<li><a href="../client/productList.php">Shoes</a></li>';
                                      echo '<li><a href="../client/productList.php">Accessories</a></li>';
                                      echo '<li><a href="../client/reviews.php">Reviews</a></li>';
                                      echo '<li><img class="search" src="../assets/Search.png" alt=""></li>';
                                      echo '<li><a href="../client/login.php"><img class="shopping" src="../assets/Shopping Cart.png" alt=""></a></li>';
                                      echo '<li class = "meron"><a href="./register.php">Register/Login</a></li>';
                                    }
                                    
                                    ?>
                                </ul>
                        </nav>
                        