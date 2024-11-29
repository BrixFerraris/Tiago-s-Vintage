<?php
include 'header.php';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

?>

<link rel="stylesheet" href="../CSS/accInfo.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="body">

    <div class="account-info-container">
        <h1>Account Info</h1>
        <div class="account-info-box">
            <div class="info-section">
                <label>Username:</label>
                <input type="text" id="username" placeholder="Current value">

                <label>First Name:</label>
                <input type="text" id="firstName" placeholder="Current value">

                <label>Last Name:</label>
                <input type="text" id="lastName" placeholder="Current value">

                <label>Contact #:</label>
                <input type="text" id="contact_number" placeholder="Current value">

                <label>Password:</label>
                <input type="password" id="password" placeholder="Current value">
            </div>

            <div class="stats-section">
                <p><strong>Total Orders:</strong> <span id="total_orders"></span></p>
                <p><strong>Available Points:</strong> <span id="available_points"></span></p>
                <div class="buttons">
                    <button class="edit-btn" id="updateAccountBtn">Update Account</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var userRole = "<?php echo $role; ?>";
            if (userRole !== 'Customer' && userRole !== '') {
                window.location.href = "../server/adminDashboard.php";
            }
            $.ajax({
                url: './includes/fetch_user.php',
                method: 'POST',
                data: { id: <?php echo $_SESSION['uID']; ?> },
                dataType: 'json',
                success: function (data) {
                    console.log(data);

                    if (data.error) {
                        alert(data.error);
                    } else {
                        $('#username').val(data.username);
                        $('#firstName').val(data.firstName);
                        $('#lastName').val(data.lastName);
                        $('#contact_number').val(data.contact);
                        $('#available_points').text(data.points);
                        $('#total_orders').text(data.completed_transactions);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error fetching user data: ' + textStatus);
                }
            });
            $('#updateAccountBtn').click(function () {
                var username = $('#username').val();
                var firstName = $('#firstName').val();
                var lastName = $('#lastName').val();
                var contactNumber = $('#contact_number').val();
                var password = $('#password').val();
                $.ajax({
                    url: './includes/update_user.php',
                    type: 'POST',
                    data: {
                        username: username,
                        firstName: firstName,
                        lastName: lastName,
                        contact: contactNumber,
                        password: password
                    },
                    dataType: 'json',
                    success: function (response) {
                        alert(response.message);
                        window.location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error updating user data: ' + textStatus);
                    }
                });
            });
        });
    </script>