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
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <link rel="icon" id="title-logo" href="../assets/icons.ico" type="image/x-icon">
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
                <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<title class="cms-title">Tiago's Vintage Boutique</title>
<body>

<div class="containerz">
                    <nav class="navbar navbar-expand-lg navbar-light">

                    <label class="cms-title title"><a class="navbar-brand" href="landing.php" id="title-mo">TIAGO'S VINTAGE <img class="cms-logo logo" src="../assets/tiagos-removebg-preview 1.png" alt=""></a></label>
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
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
                                    <a class="nav-link" href="#" style="color: white; width:100px">Contact-us<span class="sr-only">(current)</span></a>
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
                                    echo '
                                    <li class="sidebar-list-item">
                                    <a href="../client/shopcart.php" id="shop-icon">
                                        <span class="material-icons-outlined">
                                        shopping_cart
                                        </span>
                                    
                                    </a></li>';
                                    
                                    echo '<li><div class="dropdown">
                                    <a class="btn dropdown-toggle" style="background-color: #FFFFFF;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                    . $_SESSION['username'] .'
                                    </a>
                                    <div class="dropdown-menu custom-dropdown" aria-labelledby="dropdownMenuLink" id="drop-menu">
                                    <a class="dropdown-item" href="../client/toPay.php">Orders</a>
                                    <a class="dropdown-item" href="../client/accInfo.php">Settings</a>
                                    <a class="dropdown-item" href="./includes/logout.php">Log out</a>
                                    </div>
                                    </div></li>';
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
                            <a class="nav-link" href="#" style="color: white; width:100px">Contact-us<span class="sr-only">(current)</span></a>
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
                                }
                                ?>
                                </ul>                         
                        </nav>
                                
</div>

<style>
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

    nav{
        background-color:#2E6600;
    }
    #title-mo{
        color: white;
        font-family: 'Koulen', sans-serif;
    }
    li{
        display: inline-block;
        line-height: 70px;
        margin: 0 40px;
    }
    .nav-link{
        color: white;
        text-decoration: none;
        cursor: pointer;
    }
    #shop-icon{
        text-decoration: none;
        color: white;
        width: 30px;
    }    
    #drop-menu{
        position: absolute;
    }
    .material-icons-outlined{
        margin-top: 30px;
    }
    .btn{
        margin-top: 13px;
    }
    #shop-icon, #dropdownMenuLink{
        margin-left: auto;
    }

    @media only screen and (max-width: 1024px) {
    li {
        margin: 5px; /* Smaller margins for compact view */
        padding: 5px; /* Reduce padding for smaller screens */
    }
}

@media only screen and (max-width: 1440px) {
    li {
        font-size: small; /* Keep smaller font size */
        padding: 5px; /* Adjust padding for better fit */
    }
}

</style>

</body>

<script>
    document.addEventListener('DOMContentLoaded', e => {
        $('#input-datalist').autocomplete()
    }, false);
</script>

<script>
$(document).ready(function() {
    $.ajax({
        url: 'http://localhost/tiago/server/includes/getCMS.php', 
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.error) {
                $('#cms-title').text('Error loading title');
            } else {
                $('.cms-title').text(data.title);
                $('.cms-logo').attr('src', '../server/includes/uploads/' + data.logo).show();
                $('#title-logo').attr('href', '../server/includes/uploads/' + data.logo).show();
                $('.terms').text(data.terms);
            }
        },
        error: function() {
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