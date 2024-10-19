<?php
  include_once './includes/sidebar.php';
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
                    <h1>Tiago's Vintage</h1>
                    <h2>Logo</h2>
                    <img src="../images/tiagos.png" alt="" width="200px" height="200px">
                </div>
                
            </div>

            <div class="card">
                <div class="title">
                    <h1>Landing</h2>
                    <button class="edit-btn2">Edit</button>
                </div>
                <div>
                    <h2>Background Photo</h2>
                    <img src="../assets/Component 2.png" alt="" style="max-width: 50%; height: auto;">
                    <h2>Text</h2>
                    <h1>Sample Text Sample Text Sample Text </h1>
                </div>
                
            </div>

            <div class="card">
                <div class="title">
                    <h1>About us</h2>
                    <button class="edit-btn3">Edit</button>
                </div>

                <h2>Sample about us Sample about us Sample about us Sample about us Sample about us Sample about us Sample about us Sample about us Sample about us</h2> <!-- preview ng header title -->
            </div>

            <div class="card">
                <div class="title">
                    <h1>Terms & Conditions</h2>
                    <button class="edit-btn4">Edit</button>
                </div>
                <h2>Sample Terms & Conditions Sample Terms & Conditions Sample Terms & Conditions Sample Terms & Conditions Sample Terms & Conditions Sample Terms & Conditions Sample Terms & Conditions </h2>
            </div>

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
                </div>
            </div>
      <!-- End Main -->

      <!-- MODALS -->
    <!-- Modal Header -->
      <div class="modal-header">
        <div class="modals">
        <h1>Header Title & Logo</h1>
                <h4>Title: </h4>
                <input class="input" type="text" placeholder="yung current value">
                <h4>Logo:</h4>
                <input class="input" type="file">
            <div class="btns">
                <button class="btnSave">Save</button>
                <button class="btnCancel">Cancel</button>
            </div>
            
        </div>
</div>

<!-- Modal Landing bg&txt -->
    <div class="modal-landing">
            <div class="modals">
                <h1>Landing background & text</h1>
                    <h4>Backgroud Photo:</h4>
                    <input class="input" type="file">
                    <h4>Text: </h4>
                    <input class="input" type="text" placeholder="yung current value">
                    <div class="btns">
                        <button class="btnSave">Save</button>
                        <button class="btnCancel">Cancel</button>
                    </div>
                
            </div>
    </div>

    <!-- Modal About -->
    <div class="modal-about">
            <div class="modals">
                <h1>About</h1>
                    <h4>Text: </h4>
                    <textarea name="comments" id="comments" rows="15" placeholder="yung current value"></textarea>
                    <div class="btns">
                        <button class="btnSave">Save</button>
                        <button class="btnCancel">Cancel</button>
                    </div>
                
            </div>
    </div>

    <!-- Modal T&C -->
    <div class="modal-tandc">
            <div class="modals">
                <h1>Landing background & text</h1>
                    <h4>Text: </h4>
                    <textarea name="comments" id="comments" rows="15" placeholder="yung current value"></textarea>
                    <div class="btns">
                        <button class="btnSave">Save</button>
                        <button class="btnCancel">Cancel</button>
                    </div>
                
            </div>
    </div>

    <!-- Modal Contacs -->
    <div class="modal-contacts">
            <div class="modals">
                <h1>Contacts</h1>
                <table>
                    <tr>
                        <th>Icon</th>
                        <th>Value</th>
                    </tr>

                    <tr>
                        <td><img src="../assets/fb_icon.svg" alt=""></td>
                        <td><input class="input" type="text" name="fb" placeholder="yung current value"></td>
                    </tr>
                    <tr>
                        <td><img src="../assets/ig_icon.svg" alt=""></td>
                        <td><input class="input" type="text" name="ig" placeholder="yung current value"></td>
                    </tr>
                    <tr>
                        <td><img src="../assets/phone_icon.svg" alt=""></td>
                        <td><input class="input" type="text" name="number" placeholder="yung current value"></td>
                    </tr>
                    <tr>
                        <td><img src="../assets/email_icon.svg" alt=""></td>
                        <td><input class="input" type="text" name="email" placeholder="yung current value"></td>
                    </tr>
                    <tr>
                        <td><img src="../assets/location_icon.svg" alt=""></td>
                        <td><input class="input" type="text" name="location" placeholder="yung current value"></td>
                    </tr>
                </table>
                <div class="btns">
                    <button class="btnSave">Save</button>
                    <button class="btnCancel">Cancel</button>
                </div>
                
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
.delete-btn,
.btnSave,
.btnCancel {
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
.btnSave,
.btnCancel {
    background-color: #4CAF50;
}

/*MODAL */
/* modal */
.modal-header,
.modal-landing,
.modal-about,
.modal-tandc,
.modal-contacts {
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


.modals{
    background-color: white;
    width: 50%;
    height: 70%;
    display: flex;
    flex-direction: column;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.btnCancel{
    background-color: #f44336;
}
.btns{
    justify-content: space-evenly;
    display: flex;
    margin-top: auto;
}

.modals input[type="text"],[type="file"],
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

</style>
<script>
    // modal
    // Modal for Header
var modalBtn1 = document.querySelector('.edit-btn1');
var modalBg1 = document.querySelector('.modal-header');
var modalClose1 = modalBg1.querySelector('.btnCancel');

modalBtn1.addEventListener('click', function() {
    modalBg1.classList.add('modal-active');
});
modalClose1.addEventListener('click', function(){
    modalBg1.classList.remove('modal-active');
});

// Modal for Landing
var modalBtn2 = document.querySelector('.edit-btn2');
var modalBg2 = document.querySelector('.modal-landing');
var modalClose2 = modalBg2.querySelector('.btnCancel');

modalBtn2.addEventListener('click', function() {
    modalBg2.classList.add('modal-active');
});
modalClose2.addEventListener('click', function(){
    modalBg2.classList.remove('modal-active');
});

// Modal for About Us
var modalBtn3 = document.querySelector('.edit-btn3');
var modalBg3 = document.querySelector('.modal-about');
var modalClose3 = modalBg3.querySelector('.btnCancel');

modalBtn3.addEventListener('click', function() {
    modalBg3.classList.add('modal-active');
});
modalClose3.addEventListener('click', function(){
    modalBg3.classList.remove('modal-active');
});

// Modal for Terms & Conditions
var modalBtn4 = document.querySelector('.edit-btn4');
var modalBg4 = document.querySelector('.modal-tandc');
var modalClose4 = modalBg4.querySelector('.btnCancel');

modalBtn4.addEventListener('click', function() {
    modalBg4.classList.add('modal-active');
});
modalClose4.addEventListener('click', function(){
    modalBg4.classList.remove('modal-active');
});

// Modal for Contacts
var modalBtn5 = document.querySelector('.edit-btn5');
var modalBg5 = document.querySelector('.modal-contacts');
var modalClose5 = modalBg5.querySelector('.btnCancel');

modalBtn5.addEventListener('click', function() {
    modalBg5.classList.add('modal-active');
});
modalClose5.addEventListener('click', function(){
    modalBg5.classList.remove('modal-active');
});
</script>

</html>
