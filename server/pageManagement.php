<?php
session_start();

if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    if ($role === 'Super Admin') {
        include_once './includes/sidebar.php';
    } elseif ($role === 'Change Contents') {
        include_once './includes/sidebarAdd_Product.php';
    } else {
        header("location: adminDashboard.php");
        exit();
    }
} else {
    header("location: ../landing.php?error=NotLoggedIn");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="../CSS/pageManagement.css">

    <title>Page Management</title>
</head>

<body>
    <!-- Main -->
    <main class="main-container">
        <div class="main-title">
            <p class="font-weight-bold">PAGE MANAGEMENT</p>
        </div>

        <div class="content">

            <div class="card">
                <div class="title">
                    <h1>Header</h2>
                        <button class="edit-btn1">Edit</button>
                </div>
                <div class="">
                    <h2>Title</h2>
                    <h1 class="cms-title">Tiago's Vintage</h1>
                    <h2>Logo</h2>
                    <img class="cms-logo" src="../images/tiagos.png" alt="" width="200px" height="200px">
                </div>

            </div>

            <div class="card">
                <div class="title">
                    <h1>Landing</h2>
                        <button class="edit-btn2">Edit</button>
                </div>
                <div>
                    <h2>Background Photo</h2>
                    <img class="landing_bg" src="../assets/Component 2.png" alt=""
                        style="max-width: 50%; height: auto;">
                    <h2>Text</h2>
                    <h1 class="landing_text">Sample Text Sample Text Sample Text </h1>
                </div>

            </div>

            <div class="card">
                <div class="title">
                    <h1>Payment (GCash)</h2>
                        <button class="edit-btn6">Edit</button>
                </div>
                <div>
                    <h2>QR Code</h2>
                    <img class="qr_code" src="../assets/QR.png" alt="" style="max-width: 30%; height: auto;">
                </div>
            </div>

            <div class="card">
                <div class="title">
                    <h1>About us</h1>
                    <button class="edit-btn3">Edit</button>
                </div>
                <h4 class="about-us">Sample about us Sample about us Sample about us Sample about us Sample about us
                    Sample about us Sample about us Sample about us Sample about us</h4>


				<div class="abt-imgs-container">
						<img id="aboutImg_1" class="imgs_abt" src="../images/About-us picture.jpg">
						<img id="aboutImg_2" class="imgs_abt" src="../images/About-us picture.jpg">
						<img id="aboutImg_3" class="imgs_abt" src="../images/About-us picture.jpg">
						<img id="aboutImg_4" class="imgs_abt" src="../images/About-us picture.jpg">
                </div>
    
            </div>

            <div class="card">
                <div class="title">
                    <h1>Terms & Conditions</h1>
                    <button class="edit-btn4">Edit</button>
                </div>
                <h4 class="terms-conditions">Sample Terms & Conditions Sample Terms & Conditions Sample Terms &
                    Conditions Sample Terms & Conditions Sample Terms & Conditions Sample Terms & Conditions Sample
                    Terms & Conditions </h4>
            </div>
           
            <h1>Footer</h1>

            <div class="card">
                <div class="title">
                    <h1>Contacts</h2>
                        <button class="edit-btn5">Edit</button>
                </div>
                <table>
                    <tr>
                        <th>Icon</th>
                        <th>Value</th>
                    </tr>

                    <tr>
                        <td>
                            <img src="../assets/fb_icon.svg" alt="">
                        </td>
                        <td class="fb">https://www.facebook.com/profile.php?id=100063803240125</td>
                    </tr>

                    <tr>
                        <td>
                            <img src="../assets/ig_icon.svg" alt="">
                        </td>
                        <td class="ig">https://www.instagram.com/tiagos_vintage_/</td>
                    </tr>

                    <tr>
                        <td>
                            <img src="../assets/phone_icon.svg" alt="">
                        </td>
                        <td class="number">09999999999</td>
                    </tr>

                    <tr>
                        <td>
                            <img src="../assets/email_icon.svg" alt="">
                        </td>
                        <td class="email">sample@gmail.com</td>
                    </tr>

                    <tr>
                        <td>
                            <img src="../assets/location_icon.svg" alt="">
                        </td>
                        <td class="address">Bayan luma tiagos malapit kila duk sa harap</td>
                    </tr>


                </table>
            </div>

            <div class="card">
                <div class="title">
                    <h1>Footer Description</h1>
                    <button class="edit-btn7">Edit</button>
                </div>
                <h4 id="footer-value" class="footer-desc">Footer description Footer description Footer description Footer description Footer description
                Footer description Footer description Footer descriptionFooter description Footer description Footer description </h4>

            </div>
        </div>







        <!-- End Main -->

        <!-- MODALS -->
        <!-- Modal Header -->
        <div class="modal-header">
            <div class="modals">
                <form action="./includes/editTitle.php" method="post" enctype="multipart/form-data">
                    <h1>Header Title & Logo</h1>
                    <h4>Title: </h4>
                    <input name="title" class="cms-title input" type="text" placeholder="yung current value">
                    <h4>Logo:</h4>
                    <input name="logo" class="cms-logo input" type="file">
                    <div class="btns">
                        <button type="submit" class="btnSave">Save</button>
                        <button type="button" class="btnCancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Landing bg&txt -->
        <div class="modal-landing">
            <div class="modals">
                <form action="./includes/editLanding.php" method="post" enctype="multipart/form-data">
                    <h1>Landing background & text</h1>
                    <h4>Backgroud Photo:</h4>
                    <input name="landing_bg" class="input" type="file">
                    <h4>Text: </h4>
                    <input name="landing_text" class="landing_text input" type="text" placeholder="yung current value">
                    <div class="btns">
                        <button type="submit" class="btnSave">Save</button>
                        <button type="button" class="btnCancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal QR CODE -->
        <div class="modal-payment">
            <div class="modals">
                <form action="./includes/editQR.php" method="post" enctype="multipart/form-data">
                    <h1>Payment (GCash)</h1>
                    <h4>QR Code</h4>
                    <input name="qrCode" class="input" type="file" required>
                    <div class="btns">
                        <button type="submit" class="btnSave">Save</button>
                        <button type="button" class="btnCancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal About -->
        <div class="modal-about">
            <div class="modals">
                <form action="./includes/editAbout.php" method="post" enctype="multipart/form-data">
                    <h1>About</h1>
                    <h4>Text: </h4>
                    <textarea class="about-us" name="about" id="about" rows="15"
                        placeholder="yung current value"></textarea>
                    <input name="about_img" type="file" alt="">
                    <input name="about_img2" type="file" alt="">
                    <input name="about_img3" type="file" alt="">
                    <input name="about_img4" type="file" alt="">s
                    <div class="btns">
                        <button type="submit" class="btnSave">Save</button>
                        <button type="button" class="btnCancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal T&C -->
        <div class="modal-tandc">
            <div class="modals">
                <form action="./includes/editTerms.php" method="post">
                    <h1>Landing background & text</h1>
                    <h4>Text: </h4>
                    <textarea class="terms-conditions" name="terms" id="terms" rows="15"
                        placeholder="yung current value"></textarea>
                    <div class="btns">
                        <button type="submit" class="btnSave">Save</button>
                        <button type="button" class="btnCancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal Contacs -->
        <div class="modal-contacts">
            <div class="modals">
                <form action="./includes/editSocials.php" method="post" enctype="multipart/form-data">
                    <h1>Contacts</h1>
                    <table>
                        <tr>
                            <th>Icon</th>
                            <th>Value</th>
                        </tr>

                        <tr>
                            <td><img src="../assets/fb_icon.svg" alt=""></td>
                            <td><input class="fb input" type="text" name="fb" placeholder="yung current value"></td>
                        </tr>
                        <tr>
                            <td><img src="../assets/ig_icon.svg" alt=""></td>
                            <td><input class="ig input" type="text" name="ig" placeholder="yung current value"></td>
                        </tr>
                        <tr>
                            <td><img src="../assets/phone_icon.svg" alt=""></td>
                            <td><input class="number input" type="text" name="number" placeholder="yung current value">
                            </td>
                        </tr>
                        <tr>
                            <td><img src="../assets/email_icon.svg" alt=""></td>
                            <td><input class="email input" type="text" name="email" placeholder="yung current value">
                            </td>
                        </tr>
                        <tr>
                            <td><img src="../assets/location_icon.svg" alt=""></td>
                            <td><input class="address input" type="text" name="location"
                                    placeholder="yung current value"></td>
                        </tr>
                    </table>
                    <div class="btns">
                        <button type="submit" class="btnSave">Save</button>
                        <button type="button" class="btnCancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

                <!-- Modal footer text -->

        <div class="modal-footer-text">
            <div class="modals">
                <form action="./includes/editFooter.php" method="post">
                    <h1>Footer Description</h1>
                    <h4>Text: </h4>
                    <textarea class="footerr" name="footerr" id="footerr" rows="15"
                        placeholder="yung current value"></textarea>
                    <div class="btns">
                        <button type="submit" class="btnSave">Save</button>
                        <button type="button" class="btnCancel">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
        </div>
</body>



<style>
    .edit-btn1,
    .edit-btn2,
    .edit-btn3,
    .edit-btn4,
    .edit-btn5,
    .edit-btn6,
    .edit-btn7,
    .delete-btn,
    .btnSave,
    .btnCancel,
    button[type="submit"] .btnSave {
        padding: 15px 50px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: white;
    }

    .edit-btn1,
    .edit-btn2,
    .edit-btn3,
    .edit-btn4,
    .edit-btn5,
    .edit-btn6,
    .edit-btn7,
    .btnSave,
    .btnCancel,
    button[type="submit"] {
        background-color: #4CAF50;
    }

    /*MODAL */
    /* modal */
    .modal-header,
    .modal-landing,
    .modal-payment,
    .modal-about,
    .modal-tandc,
    .modal-contacts,
    .modal-footer-text {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.3s ease-in-out;
    }

    .modal-active {
        visibility: visible;
        opacity: 1;
    }


    .modals {
        background-color: white;
        width: 50%;
        height: 70%;
        display: flex;
        flex-direction: column;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .card {
        display: flex;
        margin: 20px;
    }


    .btnCancel {
        background-color: #f44336;
    }

    form {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .btns {
        justify-content: space-evenly;
        display: flex;
        margin-top: auto;
    }

    .modals input[type="text"],
    [type="file"],
    .modals textarea,
    .modals select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s ease;
        box-sizing: border-box;
    }

    .modals input[type="file"] {
        font-size: 16px;
        border: none;
    }

    .imgs_abt{
        max-width: 15%;
        max-height: auto;
        margin: 5px;
    }
    .img-div {
    
}

.abt-imgs-container {
    display: flex; /* Enables flexbox layout */
    
}


/* Responsive - Tablet */
@media screen and (min-width: 768px) and (max-width: 1024px) {
    /* Adjust modal dimensions for tablet screens */
    .modals {
        width: 75%; /* Wider modals for tablets */
        height: auto;
        padding: 20px;
    }

    /* Buttons layout for tablet */
    .btns {
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
    }

    /* Form fields adjustments */
    .modals input[type="text"],
    .modals textarea,
    .modals select {
        font-size: 15px; /* Adjust text size for tablets */
    }

    /* Adjust button padding for tablets */
    .edit-btn1,
    .edit-btn2,
    .edit-btn3,
    .edit-btn4,
    .edit-btn5,
    .edit-btn6,
    .edit-btn7 {
        padding: 15px 30px;
        font-size: 16px; /* Slightly larger text for tablets */
        margin-bottom: 10px;
    }

    /* Images in about section responsive for tablet */
    .imgs_abt {
        max-width: 10%;
        height: auto;
    }

    .abt-imgs-container {
        flex-wrap: wrap; /* Allow images to wrap */
        justify-content: space-around; /* Space images evenly */
    }

    /* Adjust table for tablet */
    table {
        display: block; /* Enables horizontal scrolling */
        overflow-x: auto;
        white-space: nowrap;
    }

    table th,
    table td {
        padding: 14px 10px; /* Adjust padding */
        font-size: 15px; /* Slightly larger font */
    }

    table img {
        max-width: 60px; /* Adjust icon size */
        height: auto;
    }

    .qr_code {
        max-width: 70%; /* Reduce size for tablets */
        height: auto;
    }

    .landing_bg {
        max-width: 100%; /* Ensure full width */
        height: auto;
    }


}


/* responsive Mobile*/
@media screen and (max-width: 768px) {
    /* Adjust modal to fit smaller screens */
    .modals {
        width: 90%; /* Make modal width fit smaller screens */
        height: auto; /* Allow height to adjust dynamically */
        padding: 15px; /* Adjust padding for better fit */
    }

    /* Stack buttons vertically for better layout on mobile */
    .btns {
        margin-top: 10px;
    }

    .btns .btnSave,
    .btns .btnCancel {
        margin-bottom: 10px; /* Add spacing between buttons */
    }

    /* Adjust text and input sizes for readability */
    .modals input[type="text"],
    .modals textarea,
    .modals select {
        font-size: 14px; /* Smaller text size for mobile */
    }

    /* Images in about section responsive */
    .imgs_abt {
        min-width: 80%;
        height: auto;
    }

    .abt-imgs-container {
        flex-wrap: wrap; /* Allow images to wrap */
        justify-content: center; /* Center align images */
    }
    .edit-btn1,
    .edit-btn2,
    .edit-btn3,
    .edit-btn4,
    .edit-btn5,
    .edit-btn6,
    .edit-btn7{
        padding: 15px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: white;
        margin-right: auto;
        margin-bottom: 10px;
    }

    .title{
        display: flex;
        flex-direction: column;
        margin-right: auto;
    }

    table {
        display: block; /* Enables horizontal scrolling on smaller screens */
        overflow-x: auto;
        white-space: nowrap; /* Prevent cell wrapping */
    }

    table th, 
    table td {
        padding: 12px 8px; /* Adjust padding for smaller screens */
        font-size: 14px; /* Reduce font size for readability */
    }

    table img {
        max-width: 50px; /* Limit icon size on mobile */
        height: auto;
    }

    .qr_code{
        min-width: 80%;
        height: auto;
    }

    .landing_bg{
        min-width: 100%;
        height: auto;
    }
    .cms-logo{
        max-width: 170px;
        max-height: 170px;
    }



}


</style>
<script>
    // modal
    // Modal for Header
    var modalBtn1 = document.querySelector('.edit-btn1');
    var modalBg1 = document.querySelector('.modal-header');
    var modalClose1 = modalBg1.querySelector('.btnCancel');

    modalBtn1.addEventListener('click', function () {
        modalBg1.classList.add('modal-active');
    });
    modalClose1.addEventListener('click', function () {
        modalBg1.classList.remove('modal-active');
    });

    // Modal for Landing
    var modalBtn2 = document.querySelector('.edit-btn2');
    var modalBg2 = document.querySelector('.modal-landing');
    var modalClose2 = modalBg2.querySelector('.btnCancel');

    modalBtn2.addEventListener('click', function () {
        modalBg2.classList.add('modal-active');
    });
    modalClose2.addEventListener('click', function () {
        modalBg2.classList.remove('modal-active');
    });

    // Modal for Payment
    var modalBtn6 = document.querySelector('.edit-btn6');
    var modalBg6 = document.querySelector('.modal-payment');
    var modalClose6 = modalBg6.querySelector('.btnCancel');

    modalBtn6.addEventListener('click', function () {
        modalBg6.classList.add('modal-active');
    });
    modalClose6.addEventListener('click', function () {
        modalBg6.classList.remove('modal-active');
    });


    // Modal for About Us
    var modalBtn3 = document.querySelector('.edit-btn3');
    var modalBg3 = document.querySelector('.modal-about');
    var modalClose3 = modalBg3.querySelector('.btnCancel');

    modalBtn3.addEventListener('click', function () {
        modalBg3.classList.add('modal-active');
    });
    modalClose3.addEventListener('click', function () {
        modalBg3.classList.remove('modal-active');
    });

    // Modal for Terms & Conditions
    var modalBtn4 = document.querySelector('.edit-btn4');
    var modalBg4 = document.querySelector('.modal-tandc');
    var modalClose4 = modalBg4.querySelector('.btnCancel');

    modalBtn4.addEventListener('click', function () {
        modalBg4.classList.add('modal-active');
    });
    modalClose4.addEventListener('click', function () {
        modalBg4.classList.remove('modal-active');
    });

    // Modal for Contacts
    var modalBtn5 = document.querySelector('.edit-btn5');
    var modalBg5 = document.querySelector('.modal-contacts');
    var modalClose5 = modalBg5.querySelector('.btnCancel');

    modalBtn5.addEventListener('click', function () {
        modalBg5.classList.add('modal-active');
    });
    modalClose5.addEventListener('click', function () {
        modalBg5.classList.remove('modal-active');
    });



    // Modal for Footer text
    var modalBtn7 = document.querySelector('.edit-btn7');
    var modalBg7 = document.querySelector('.modal-footer-text');
    var modalClose7 = modalBg7.querySelector('.btnCancel');

    modalBtn7.addEventListener('click', function () {
        modalBg7.classList.add('modal-active');
    });
    modalClose7.addEventListener('click', function () {
        modalBg7.classList.remove('modal-active');
    });

    $(document).ready(function () {
        $.ajax({
            url: './includes/getCMS.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.error) {
                    $('#cms-title').text('Error loading title');
                } else {
                    $('.cms-title').text(data.title);
                    $('.cms-logo').attr('src', './includes/uploads/' + data.logo).show();
                    $('.landing_text').text(data.landing_text);
                    $('.landing_bg').attr('src', './includes/uploads/' + data.landing_bg).show();
                    $('.about-us').text(data.about);
                    $('.terms-conditions').text(data.terms);
                    $('.fb').text(data.fb);
                    $('.ig').text(data.ig);
                    $('.number').text(data.number);
                    $('.email').text(data.email);
                    $('.address').text(data.address);
                    $('.qr_code').attr('src', './includes/uploads/' + data.qr).show();
                    $('#footer-value').text(data.footer);
                    $('#aboutImg_1').attr('src', './includes/uploads/' + data.about_img).show();
                    $('#aboutImg_2').attr('src', './includes/uploads/' + data.about_img2).show();
                    $('#aboutImg_3').attr('src', './includes/uploads/' + data.about_img3).show();
                    $('#aboutImg_4').attr('src', './includes/uploads/' + data.about_img4).show();

                    $('.cms-title').val(data.title);
                    $('.landing_text').val(data.landing_text);
                    $('.about-us').val(data.about);
                    $('.terms-conditions').val(data.terms);
                    $('.fb').val(data.fb);
                    $('.ig').val(data.ig);
                    $('.number').val(data.number);
                    $('.email').val(data.email);
                    $('.address').val(data.address);
                    $('#footerr').val(data.footer);
                }
            },
            error: function () {
                $('#cms-title').text('Error loading data');
            }
        });
    });
</script>
<script src="../test/sidebarToggle.js"></script>


</html>