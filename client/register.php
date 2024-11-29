<?php
include 'header.php';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

?>

<!-- Main -->

<link rel="stylesheet" href="../CSS/registerClient.css">



<body>
    <style>
        .haha {
            width: 100%;
        }

        .is-valid {
            border-color: #198754 !important;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }
    </style>

    <main class="main-container">
        <div id="alert" style="display: none;" class="alert alert-danger" role="alert">
            <span id="alert-message"></span>
        </div>
        <div class="main-title">
            <p class="font-weight-bold">Register</p>


        </div>

        <div class="form-container">
            <form id="registration-form" action="./includes/register.php" method="post" enctype=" ">


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
                    <input class="haha" type="text" id="contact" name="contact" placeholder="Contact Number"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                        required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input class="haha" type="email" id="email" name="email" placeholder="E-mail" required>
                    <a class="resend" style="float: right">Send OTP</a>
                    <span id="countdown"></span>
                </div>

                <div class="form-group">
                    <label for="otp">OTP:</label>
                    <div>
                        <input class="haha" type="text" id="otp-input" maxlength="6" pattern="\d{6}" required>
                        <button id="verify" name="verify" type="button" style="width: 20%;">Verify OTP</button>
                    </div>
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
                        <input type="password" id="confPassword" name="ConfPassword" placeholder="Confirm Password"
                            required>
                        <span toggle="#confPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>
                <!-- Checkbox and Terms & Conditions Modal -->
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="termsCheckbox" required>
                    <label class="form-check-label" for="termsCheckbox">
                        I agree to the <span style="color: blue; cursor: pointer;" data-toggle="modal"
                            data-target="#termsModal">Terms & Conditions</span>
                    </label>
                </div>
                <button id="register-btn" name="register" type="submit">Register</button>
                <div class="aabtm">
                    <a href="./login.php" style="text-decoration: none; ">Already have an account? Click here to Log on!
                    </a>
                </div>
            </form>
        </div>


    </main>


    <!-- Modal for Terms & Conditions -->
    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms & Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="terms" style="color: black;">SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS
                        SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS SAMPLE TERMS
                        AND CONDITIONS SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND CONDITIONS SAMPLE TERMS AND
                        CONDITIONS</p>
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
    $(document).ready(function () {
        var userRole = "<?php echo $role; ?>";
        if (userRole !== 'Customer' && userRole !== '') {
            window.location.href = "../server/adminDashboard.php";
        }
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
        } else if (errorValue === "UsernameTaken") {
            alert("Username is already taken!");
        } else if (errorValue === "none") {
            alert("Success! No issues detected.");
        }
        let isValidOTP = false;
        let isTermsChecked = false;
        function showAlert(message) {
            $('#alert-message').text(message);
            $("#alert").fadeIn().delay(3000).fadeOut();
        }
        function startCountdown(durationInSeconds) {
            let timeLeft = durationInSeconds;
            const countdownElement = $('#countdown');
            const resendButton = $('.resend');
            const timer = setInterval(function () {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;

                const formattedTime = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                countdownElement.text("Resend in: " + formattedTime);

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    countdownElement.hide();
                    resendButton.show().text('Resend OTP');
                }
                timeLeft--;
            }, 1000);
        }
        $('#verify').click(function (e) {
            e.preventDefault();
            const otpValue = $('#otp-input').val();
            $.ajax({
                url: './includes/validateOTP.php',
                method: 'POST',
                data: {
                    otp: otpValue
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === "success") {
                        isValidOTP = true;
                        $('#alert').removeClass('alert-danger').addClass('alert-success');
                        showAlert("OTP validated successfully");
                        enableRegisterButton();
                    } else {
                        $('#register-btn').prop('disabled', true);
                        isValidOTP = false;
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error validating OTP:', error);
                    $('#otp-status').html('<span class="text-danger">Error verifying OTP. Please try again.</span>');
                }
            });
        });
        $('.resend').click(function (e) {
            e.preventDefault();
            const email = $('#email').val();
            const resendButton = $(this);

            if (!email || !isValidEmail(email)) {
                showAlert("Enter Valid Email");
                return;
            }

            resendButton.text('Sending...');
            $.ajax({
                url: './includes/sendOTP.php',
                type: 'POST',
                data: { email: email },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        const countdownElement = $('#countdown');
                        resendButton.text('Resend OTP');
                        resendButton.hide();
                        countdownElement.show();
                        startCountdown(120);
                        $('#alert').removeClass('alert-danger').addClass('alert-success');
                        showAlert("OTP sent successfully");
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Error connecting to server');
                    resendButton.prop('disabled', false);
                    resendButton.text('Send OTP');
                }
            });
        });
        $('#registration-form').on('submit', function (event) {
            if (!isValidOTP || !isTermsChecked) {
                event.preventDefault();
                alert('You must check the terms and verify the OTP.');
            }
        });
        function enableRegisterButton() {
            if (isValidOTP && isTermsChecked) {
                $('#register-btn').prop('disabled', false);
            }
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        $('#termsCheckbox').change(function () {
            if ($(this).is(':checked')) {
                isTermsChecked = true;
                enableRegisterButton();
            } else {
                isTermsChecked = false;
                enableRegisterButton();
            }
        });

        $(".toggle-password").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $('#password, #confPassword').on('input', function () {
            const password = $('#password').val();
            const confPassword = $('#confPassword').val();

            if (password.length < 8) {
                $('#password')[0].setCustomValidity("Password must be at least 8 characters long");
            } else {
                $('#password')[0].setCustomValidity("");
            }

            if (confPassword && confPassword !== password) {
                $('#confPassword')[0].setCustomValidity("Passwords do not match");
            } else {
                $('#confPassword')[0].setCustomValidity("");
            }
        });
    });
</script>