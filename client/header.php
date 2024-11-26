<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="https://fonts.cdnfonts.com/css/koulen" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" id="title-logo" href="../assets/icons.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <title class="cms-title">Tiago's Vintage Boutique</title>

<body>

    <div class="containerz">
        <nav class="navbar navbar-expand-lg navbar-light">

            <label class="cms-title title"><a class="navbar-brand" href="landing.php" id="title-mo">TIAGO'S VINTAGE <img
                        class="cms-logo logo" src="../assets/tiagos-removebg-preview 1.png" alt=""></a></label>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                    <?php
                    session_start();
                    if (isset($_SESSION["username"])) {

                        echo '<li class="nav-item active">
                                    <a class="nav-link" href="landing.php" style="color: white;">Home <span class="sr-only">(current)</span></a>
                                    </li>';


                        echo '<li class="nav-item active">
                                        <a class="nav-link" href="../client/shop.php" style="color: white;">Product<span class="sr-only">(current)</span></a>
                                    </li>';


                        echo '<li class="nav-item active">
                                        <a class="nav-link" href="../client/reviews.php" style="color: white;">Reviews<span class="sr-only">(current)</span></a>
                                    </li>';

                        echo '<li class="nav-item active">
                                    <a class="nav-link" href="../client/contactUs.php" style="color: white; width:100px">Contact Us<span class="sr-only">(current)</span></a>
                                    </li>';

                        echo '<li class="nav-item active" style="width: 190px; margin-top: 13px;">
                                <div class="form-group" style="margin-top: 13px; position: relative;">
                                    <input type="text" 
                                        class="form-control" 
                                        placeholder="Search for products..." 
                                        id="input-datalist" 
                                        style="padding-right: 35px;">
                                    <i class="fa fa-search" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); color: #888; cursor: pointer;"></i>
                                </div>
                                <div id="search-results" style="position: absolute; z-index: 1000; background: white; border: 1px solid #ccc; display: none; width: 190px;"></div>
                            </li>';

                        echo '
                                        <li class="sidebar-list-item">
                                            <a href="../client/shopcart.php" id="shop-icon">
                                                <span class="material-icons-outlined">
                                                    shopping_cart
                                                </span>
                                                <span class="badge" id="cart-badge">0</span> <!-- Replace 3 with dynamic content if needed -->
                                            </a>
                                        </li>';


                        echo '<li class="user-drop">
                                    <div class="dropdown user-dropdown">
                                        <a class="btn dropdown-toggle user-dropdown-toggle" style="background-color: #FFFFFF;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                            . $_SESSION['username'] . '
                                        </a>
                                        <div class="dropdown-menu custom-dropdown" aria-labelledby="dropdownMenuLink" id="drop-menu-user">
                                            <a class="dropdown-item" href="../client/toPay.php">Orders</a>
                                            <a class="dropdown-item" href="../client/accInfo.php">Settings</a>
                                            <a class="dropdown-item" href="./includes/logout.php">Log out</a>
                                        </div>
                                    </div>
                                </li>';

                        echo '<div id="floatingButton" class="dropup rounded-circle">
                                    <button 
                                        id="notificationDropdownButton" 
                                        type="button" 
                                        class="btn btn-success btn-lg dropdown-toggle hide-toggle position-relative" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false" 
                                        aria-haspopup="true" style="background-color:#2E6600;">
                                        <i class="fa-solid fa-bell"></i>
                                        <span class="visually-hidden">Notifications</span>
                                        <!-- Notification Badge -->
                                        <span id="notificationBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        3
                                        <span class="visually-hidden">unread notifications</span>
                                        </span>
                                    </button>
                                    
                                    <!-- Dropdown menu -->
                                    <ul 
                                        id="notificationDropdownMenu" 
                                        class="dropdown-menu dropdown-menu-end p-2 shadow-lg" 
                                        aria-labelledby="notificationDropdownButton">
                                        <li class="dropdown-item d-flex align-items-center" id="notif-cust">
                                        <i class="fa-solid fa-check-circle text-success me-3"></i>
                                        <span>Your Order is Accepted!</span>
                                        </li>
                                        <li class="dropdown-item d-flex align-items-center" id="notif-cust">
                                        <i class="fa-solid fa-times-circle text-danger me-3" id="notif-cust"></i>
                                        <span>Your Order has been Cancelled.</span>
                                        </li>
                                        <li class="dropdown-item d-flex align-items-center" id="notif-cust">
                                        <i class="fa-solid fa-box-open text-primary me-3"></i>
                                        <span>Your Order is ready for Pickup!</span>
                                        </li>
                                        <li class="dropdown-item d-flex align-items-center" id="notif-cust">
                                        <i class="fa-solid fa-truck text-warning me-3"></i>
                                        <span>Your Order is ready for Delivery!</span>
                                        </li>
                                    </ul>
                                    </div>
                                        ';


                    } else {

                        echo '<li class="nav-item active">
                            <a class="nav-link" href="landing.php" style="color: white;">Home <span class="sr-only">(current)</span></a>
                            </li>';


                        echo '<li class="nav-item active">
                                <a class="nav-link" href="../client/shop.php" style="color: white;">Product<span class="sr-only">(current)</span></a>
                            </li>';


                        echo '<li class="nav-item active">
                                <a class="nav-link" href="../client/reviews.php" style="color: white;">Reviews<span class="sr-only">(current)</span></a>
                            </li>';


                        echo '<li class="nav-item active">
                            <a class="nav-link" href="../client/contactUs.php" style="color: white; width:100px">Contact Us<span class="sr-only">(current)</span></a>
                            </li>';


                        echo '<li class="nav-item active" style="width: 190px; margin-top: 13px; "> 
                            <div class="form-group" style="margin-top: 13px; position: relative;">
                                <input type="text" 
                                    class="form-control" 
                                    placeholder="Search for products..." 
                                    list="list-timezone" 
                                    id="input-datalist" 
                                    style="padding-right: 35px;">
                                <datalist id="list-timezone">
                                    <option value="Asia/Aden"></option>
                                    <option value="Asia/Aqtau"></option>
                                    <option value="Asia/Baghdad"></option>
                                    <option value="Asia/Barnaul"></option>
                                    <option value="Asia/Chita"></option>
                                    <option value="Asia/Dhaka"></option>
                                    <option value="Asia/Famagusta"></option>
                                    <option value="Asia/Hong_Kong"></option>
                                    <option value="Asia/Jayapura"></option>
                                    <option value="Asia/Kuala_Lumpur"></option>
                                    <option value="Asia/Jakarta"></option>
                                </datalist>
                                <i class="fa fa-search" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); color: #888; cursor: pointer;"></i>
                            </div>
                        </li>';


                        echo '<li class="nav-item active">
                            <a class="nav-link" href="../client/login.php" style="color: white;">Login/Register<span class="sr-only">(current)</span></a>
                        </li>';
                    } ?>
                </ul>
        </nav>
    </div>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'http://localhost/Tiago/client/includes/getNotification.php',
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    $('#notificationBadge').text(data.notification_count);
                    $('#notificationDropdownMenu').empty();
                    if (data.notifications.length > 0) {
                        data.notifications.forEach(function (notification) {
                            var listItem = $(`<li data-trans_id="${notification.transaction_id}" class="dropdown-item d-flex align-items-center"></li>`);
                            var iconClass;
                            if (notification.status === 'Ready For Pickup') {
                                iconClass = 'fa-box-open text-primary';
                            } else if (notification.status === 'Out For Delivery') {
                                iconClass = 'fa-truck text-warning';
                            } else if (notification.status === 'Cancelled') {
                                iconClass = 'fa-times-circle text-danger';
                            } else {
                                iconClass = 'fa-check-circle text-success';
                            }
                            listItem.append(`<i class="fa-solid ${iconClass} me-3"></i>`);
                            listItem.append(`<span>Your Order: <span><strong>${notification.transaction_id}</strong></span> is ${notification.status || 'You have a new notification.'}</span>`);
                            listItem.on('click', function () {
                                const transactionId = $(this).data('trans_id'); 
                                if (notification.status === 'Ready For Pickup' || notification.status === 'Out For Delivery') {
                                    $.ajax({
                                        url: 'http://localhost/Tiago/server/includes/updateSeen.php',
                                        method: 'POST',
                                        data: {
                                            transactionId: transactionId,
                                            table: 'transactions'
                                        },
                                        success: function (response) {
                                            if (response === 'success') {
                                                window.location.href = './toReceived.php';
                                            } else {
                                                alert('Failed to update status');
                                            }
                                        },
                                        error: function (xhr, status, error) {
                                            console.error('Error:', error);
                                            alert('An error occurred while updating the status');
                                        }
                                    });
                                } else if (notification.status === 'Cancelled') {
                                    $.ajax({
                                        url: 'http://localhost/Tiago/server/includes/updateSeen.php',
                                        method: 'POST',
                                        data: {
                                            transactionId: transactionId,
                                            table: 'transactions'
                                        },
                                        success: function (response) {
                                            if (response === 'success') {
                                                window.location.href = './cancelled.php';
                                            } else {
                                                alert('Failed to update status');
                                            }
                                        },
                                        error: function (xhr, status, error) {
                                            console.error('Error:', error);
                                            alert('An error occurred while updating the status');
                                        }
                                    });
                                }
                            });
                            $('#notificationDropdownMenu').append(listItem);
                        });
                    } else {
                        $('#notificationDropdownMenu').append('<li class="dropdown-item">No new notifications</li>');
                    }
                },
                error: function () {
                    console.error('Error fetching data');
                }
            });
            $.ajax({
                url: 'http://localhost/Tiago/client/includes/getAddCarts.php',
                type: 'GET',
                success: function (data) {
                    var results = JSON.parse(data);
                    $.each(results, function (index, carts) {
                        var cartBadge = $('#cart-badge');
                        cartBadge.text(carts.total_transactions);
                    });
                },
                error: function () {
                    console.error('Error fetching data');
                }
            });
            $('#input-datalist').on('input', function () {
                var query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: 'http://localhost/Tiago/client/includes/searchProducts.php',
                        type: 'GET',
                        data: { query: query },
                        success: function (data) {
                            var results = JSON.parse(data);
                            var resultsContainer = $('#search-results');
                            resultsContainer.empty();
                            if (results.length > 0) {
                                $.each(results, function (index, product) {
                                    resultsContainer.append(`
                                        <div class="result-item" data-id="${product.id}" style="padding: 10px; cursor: pointer; display: flex; align-items: center;">
                                            <img src="../server/includes/uploads/${product.img1}" alt="${product.title}" style="width: 30px; height: 30px; margin-right: 10px;">
                                            <span>${product.title}</span>
                                        </div>
                                    `);
                                });
                                resultsContainer.show();
                            } else {
                                resultsContainer.append(`
                                        <div class="result-item" style="padding: 10px; cursor: pointer; display: flex; align-items: center;">
                                            No Results Found
                                        </div>
                                    `);;
                            }
                        },
                        error: function () {
                            console.error('Error fetching data');
                        }
                    });
                } else {
                    $('#search-results').hide();
                }
            });

            $(document).on('click', function (event) {
                if (!$(event.target).closest('#input-datalist, #search-results').length) {
                    $('#search-results').hide();
                }
            });

            $(document).on('click', '.result-item', function () {
                var productId = $(this).data('id');
                window.location.href = 'newItem.php?productID=' + productId;
            });
        });
    </script>

    <style>
        #shop-icon {
            position: relative;
        }

        #cart-badge {
            position: absolute;
            top: -15px;
            right: -25px;
            background-color: red;
            color: white;
            padding: 5px;
            border-radius: 50%;
            font-size: 15px;
            padding: 5px 10px;
            /* Adjust padding for the size */
            border-radius: 50%;
            min-width: 20px;
            /* Ensure the badge is large enough */
            height: 25px;
        }

        #notif-cust {
            margin: 0%;
        }

        #floatingButton {
            position: fixed;
            /* Keeps the button sticky on the screen */
            bottom: 20px;
            /* Position from the bottom */
            right: 20px;
            /* Position from the right */
            width: 60px;
            /* Circle button size */
            height: 60px;
            padding: 0;
            z-index: 1050;
            margin-bottom: 50px;
            margin-right: 10px;
            /* Keeps it above other content */
        }

        #floatingButton button {
            border-radius: 50%;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }

        #floatingButton i {
            font-size: 1.5rem;
        }

        #notificationBadge {
            font-size: 0.75rem;
            padding: 0.4em 0.6em;
            transform: translate(-50%, -50%);
        }

        #notificationDropdownMenu {
            min-width: 280px;
            /* Ensure the dropdown has a consistent size */
            max-height: 300px;
            /* Set a maximum height for the dropdown */
            overflow-y: auto;
            /* Enable vertical scrolling when content exceeds max height */
            border-radius: 8px;
            /* Rounded corners for the dropdown */
        }

        /* Scrollbar styling for the dropdown */
        #notificationDropdownMenu::-webkit-scrollbar {
            width: 8px;
            /* Width of the scrollbar */
        }

        #notificationDropdownMenu::-webkit-scrollbar-thumb {
            background-color: #888;
            /* Color of the scrollbar thumb */
            border-radius: 4px;
            /* Rounded scrollbar thumb */
        }

        #notificationDropdownMenu::-webkit-scrollbar-thumb:hover {
            background-color: #555;
            /* Darker scrollbar thumb on hover */
        }

        #notificationDropdownMenu .dropdown-item {
            padding: 10px;
            /* Add spacing for each item */
            transition: background-color 0.2s;
            /* Smooth hover effect */
        }

        #notificationDropdownMenu .dropdown-item:hover {
            background-color: #f1f1f1;
            /* Highlight item on hover */
        }

        #notificationDropdownMenu .dropdown-item i {
            font-size: 1.25rem;
            /* Adjust icon size */
        }

        #input-datalist {
            border-radius: 20px;
            border: 1px solid #ccc;
            transition: all 0.3s ease-in-out;
        }

        #input-datalist:focus {
            border-color: #2E6600;
            box-shadow: 0 0 5px rgba(46, 102, 0, 0.5);
        }

        .fa-search {
            transition: color 0.3s ease;
        }

        .fa-search:hover {
            color: #2E6600;
        }

        /* General navigation background */
        nav {
            background-color: #2E6600;
        }

        /* Title styling */
        #title-mo {
            color: white;
            font-family: 'Koulen', sans-serif;
        }

        /* List items in the navigation */
        li {
            display: inline-block;
            line-height: 70px;
            margin: 0 40px;
        }

        /* Links in navigation */
        .nav-link {
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        /* Shop icon styling */
        #shop-icon {
            text-decoration: none;
            color: white;
            width: 30px;
        }

        /* Dropdown menu styling */
        #drop-menu-user {
            position: absolute;
            background-color: #FFFFFF;
            /* Make the dropdown white */
            border-radius: 5px;
            /* Rounded corners for the dropdown */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Soft shadow for the dropdown */
            min-width: 200px;
            /* Ensure the dropdown menu has a consistent width */
            z-index: 1050;
            /* Ensure it appears above other elements */
        }

        /* Customize the dropdown button */
        #dropdownMenuLink {
            background-color: #FFFFFF;
            /* Make the button background white */
            color: #2E6600;
            /* Match the text color to the navbar color */
            padding: 10px 20px;
            /* Add padding to make the button larger */
            border-radius: 5px;
            /* Rounded corners for the button */
        }

        /* Hover effect on the dropdown button */
        #dropdownMenuLink:hover {
            background-color: #F0F0F0;
            /* Slightly darker hover effect */
        }

        /* Dropdown items styling */
        #drop-menu .dropdown-item {
            padding: 10px;
            color: #2E6600;
            /* Text color */
            background-color: white;
            /* Ensure items have a white background */
            transition: background-color 0.2s ease;
            /* Smooth hover effect */
        }

        /* Hover effect for dropdown items */
        #drop-menu .dropdown-item:hover {
            background-color: #F1F1F1;
            /* Light hover effect */
        }

        /* Additional styling for material icons inside the dropdown */
        .material-icons-outlined {
            margin-top: 30px;
        }

        /* Button styles */
        .btn {
            margin-top: 13px;
        }

        /* Adjust for smaller screens */
        @media only screen and (max-width: 1024px) {
            li {
                margin: 5px;
                /* Smaller margins for compact view */
                padding: 5px;
                /* Reduce padding for smaller screens */
            }
        }

        @media only screen and (max-width: 1440px) {
            li {
                font-size: small;
                /* Keep smaller font size */
                padding: 5px;
                /* Adjust padding for better fit */
            }

            .user-drop {
                margin-left: 5px;
            }

        }
    </style>

</body>



<script>
    $(document).ready(function () {
        $.ajax({
            url: 'http://localhost/tiago/server/includes/getCMS.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.error) {
                    $('#cms-title').text('Error loading title');
                } else {
                    $('.cms-title').text(data.title);
                    $('.cms-logo').attr('src', '../server/includes/uploads/' + data.logo).show();
                    $('#title-logo').attr('href', '../server/includes/uploads/' + data.logo).show();
                    $('.terms').text(data.terms);
                }
            },
            error: function () {
                $('#cms-title').text('Error loading data');
            }
        });
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        const error = getQueryParam('error');

        const errorMessages = {
            none: "Success",
            PassNotMatching: "Passwords do not match.",
            EmptyInput: "Please fill in all fields.",
            InvalidUsername: "The username provided is invalid.",
            UsernameTaken: "This username is already taken."
        };

        if (error && errorMessages[error]) {
            alert(errorMessages[error]);
        }

    });
</script>