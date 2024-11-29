<?php
include 'header.php';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

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
                    <label for="username">Email:</label>
                    <input type="text" id="username" name="username" placeholder="E-Mail" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <div class="input-container">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>

                <button name="submit" type="submit">Log in</button>
                <div class="aabtm">

                    <a href="./register.php" style="text-decoration: none;">Doesn't have an account? Click here to
                        Register! </a>
                </div>


        </form>
    </div>
</main>

<!-- End Main -->

<script>
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        const results = regex.exec(window.location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }
    const errorValue = getUrlParameter('error');
    if (errorValue === "EmptyInput") {
        alert("Empty input detected!");
    } else if (errorValue === "PassNotMatching") {
        alert("Passwords do not match!");
    } else if (errorValue === "WrongLogin") {
        alert("Invalid Username or Password");
    } else if (errorValue === "none") {
        alert("Success! No issues detected.");
    }
    $(".toggle-password").click(function () {
        var userRole = "<?php echo $role; ?>";
        if (userRole !== 'Customer' && userRole !== '') {
            window.location.href = "../server/adminDashboard.php";
        }
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>


<?php
include '../test/newFooter.php';
?>