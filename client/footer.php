<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="../CSS/footer.css">
    <title>Footer</title>
</head>
<body>
     
 <footer>
    <div class="footerContainer">
        <div class="socialIcons">
            <a href="https://www.facebook.com/profile.php?id=100063803240125"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.instagram.com/tiagos_vintage_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i class="fa-brands fa-instagram"></i></a>
        </div>
        <div class="footerNav">
            <div class="foots">
            <ul><li><a href="../client/landing.php"><p>Home</p> </a></li>
                <li><a> <p class="abtt"> About </p> </a></li>
                <li><a> <p class="contt"> Contact Us </p> </a></li>
   
            </ul>
            </div>
        </div>
        
    </div>

</footer>
</body>
    <div class="modal-abt">
            <div class="modals">
                    <h1>About Us</h1>
                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </h4>
                    <div class="btns">
                        <button class="btnClose">Close</button>
                    </div>
                
            </div>
    </div>
    



    <div class="modal-contt">
            <div class="modals">
                    <h1>Contact Us</h1>
                        
                <table>
                    <tr>
                        <td>
                            <img src="../assets/fb_icon.svg" alt="">
                        </td>
                        <td>https://www.facebook.com/profile.php?id=100063803240125</td>
                    </tr>

                    <tr>
                        <td>
                            <img src="../assets/ig_icon.svg" alt="">
                        </td>
                        <td>https://www.instagram.com/tiagos_vintage_/</td>
                    </tr>

                    <tr>
                        <td>
                            <img src="../assets/phone_icon.svg" alt="">
                        </td>
                        <td>09999999999</td>
                    </tr>

                    <tr>
                        <td>
                            <img src="../assets/email_icon.svg" alt="">
                        </td>
                        <td>sample@gmail.com</td>
                    </tr>

                    <tr>
                        <td>
                            <img src="../assets/location_icon.svg" alt="">
                        </td>
                        <td>Bayan luma tiagos malapit kila duk sa harap</td>
                    </tr>

                </table>

                    <div class="btns">
                        <button class="btnClose">Close</button>
                    </div>
        </div>
    </div>



</html>

<script>
//modal abt
var modalBtn1 = document.querySelector('.abtt');
var modalBg1 = document.querySelector('.modal-abt');
var modalClose1 = modalBg1.querySelector('.btnClose');

modalBtn1.addEventListener('click', function() {
    modalBg1.classList.add('modal-active');
});
modalClose1.addEventListener('click', function(){
    modalBg1.classList.remove('modal-active');
});


//modal contt
var modalBtn2 = document.querySelector('.contt');
var modalBg2 = document.querySelector('.modal-contt');
var modalClose2 = modalBg2.querySelector('.btnClose');

modalBtn2.addEventListener('click', function() {
    modalBg2.classList.add('modal-active');
});
modalClose2.addEventListener('click', function(){
    modalBg2.classList.remove('modal-active');
});






</script>