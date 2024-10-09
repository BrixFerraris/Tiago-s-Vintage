<?php
include 'header.php';
?>

<!-- Main -->

<link rel="stylesheet" href="../CSS/registerClient.css">


<main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">Register</p>
        </div>

    <!-- form add products -->
    <div class="form-container">
        <form action="./includes/register.php" method="post" enctype=" ">


            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
            </div>

            <div class="form-group">
                <label for="contact">ContactNum:</label>
                <input type="text" id="contact" name="contact" placeholder="ContactNum" required>
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <label for="confPassword">Confirm Password:</label>
                <input type="password" id="confPassword" name="ConfPassword" placeholder="Confirm Password" required>

            </div>

            <button name="register" type="submit">Register</button>
            <div class="aabtm">

                <a href="./login.php">Already have an account? Click here to Log on! </a>
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