<?php
include 'header.php';
?>

<!-- Main -->


<link rel="stylesheet" href="../CSS/loginClient.css">


<main class="main-container">
        <div class="main-title">
            <p class="font-weight-bold">Log in</p>
        </div>

    <!-- login -->

    <div class="form-container">
        <form action="./includes/login.php" method="post" enctype=" ">
            <div class="form-group">


            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="title" placeholder="Password" required>

            </div>

            <button name="submit" type="submit">Log in</button>
            <div class="aabtm">

                <a href="./register.php">Doesn't have an account? Click here to Register! </a>
            </div>
            

        </form>
    </div>
    </main>
    <!-- End Main -->

    <style>



    </style>


<?php
include 'footer.php';
?>