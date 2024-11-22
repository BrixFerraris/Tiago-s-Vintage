<?php
include 'header.php';
?>

<!-- Main -->

<link rel="stylesheet" href="../CSS/registerClient.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<body>
<style>
.haha {
    width: 100%;
}


    </style>

<main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">Register</p>

          
        </div>

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
                <input class="haha" type="text" id="contact" name="contact" placeholder="Contact Number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input class="haha" type="email" id="email" name="email" placeholder="E-mail" required>
                <a class="resend" style="float: right" href="#">Send OTP</a>            
            </div>


            <div class="form-group">
                <label for="otp">OTP:</label>
                <div>
                    <input class="haha" type="number" id="otp" name="otp" placeholder="OTP" required style= "width: 50%;">
                    <button id="verify" name="verify" type="submit" style="width: 20%;">Verify OTP</button>
                </div>

            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="confPassword">Confirm Password:</label>
                <div class="input-container">
                    <input type="password" id="confPassword" name="ConfPassword" placeholder="Confirm Password" required>
                    <span toggle="#confPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
            </div>
            <!-- Checkbox and Terms & Conditions Modal -->
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="termsCheckbox" required>
                <label class="form-check-label" for="termsCheckbox">
                    I agree to the <span style="color: blue; cursor: pointer;" data-toggle="modal" data-target="#termsModal">Terms & Conditions</span>
                </label>
            </div>

            <button id="register-btn" name="register" type="submit">Register</button>
            <div class="aabtm">

            <a href="./login.php" style="text-decoration: none; ">Already have an account? Click here to Log on! </a>
            </div>
            
            
        </form>
    </div>


    </main>


<!-- Modal for Terms & Conditions -->
       <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms & Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <p class="terms" style="color: black;">SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS</p>
                    <!-- You can add your actual terms and conditions here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    </body>

    <?php
include '../test/newFooter.php';
?> 
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
    $('#register-btn').prop('disabled', true);

    $('#termsCheckbox').change(function() {
        if ($(this).is(':checked')) {
            $('#register-btn').prop('disabled', false); 
        } else {
            $('#register-btn').prop('disabled', true);
        }
    });
});



    //shhow password

    $(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});


</script>


    <!-- End Main -->


