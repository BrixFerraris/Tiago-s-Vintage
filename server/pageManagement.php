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
                <!-- Example SVG Icon -->
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
        </div>
    </div>
</body>



<style>
.edit-btn1,
.edit-btn2,
.edit-btn3,
.edit-btn4,
.edit-btn5,
.delete-btn{
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: white;
}

.edit-btn1,
.edit-btn2,
.edit-btn3,
.edit-btn4,
.edit-btn5 {
    background-color: #4CAF50;
}
</style>
</html>
