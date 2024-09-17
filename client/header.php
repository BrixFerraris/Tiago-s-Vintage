<!DOCTYPE html>
<html lang="en"  data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.cdnfonts.com/css/koulen" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/icons.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/icons.ico" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="stylesheet" href="../CSS/product.css">
    <title>Tiago's Vintage</title>
</head>
<body>

<?php
session_start();


if (isset($_SESSION["username"])) {

  echo "
  <nav class='navbar' role='navigation' aria-label='main navigation'> 
      <div class='navbar-brand'> 
          <img src='../images/tiagos.png' width='100' height='100'> 
      </div> 
      <div class='navbar-menu'> 
          <div class='navbar-start'>
          </div> 
          <div class='navbar-end'> 
              <a class='navbar-item'>Home</a> 
              <a class='navbar-item'>About</a>
              <input class='input' type='text' name='' id='search'>
               <div class='dropdown'>
        <a>
            <span class='material-icons-outlined'>person</span>
        </a>
        <div class='dropdown-content'>
            <a href='#'>Settings</a>
            <a href='./includes/logout.php'>Log Out</a>
        </div>
    </div>         
          </div> 
      </div> 
  </nav>
          
  <div id='variety'>
      <ul class='type'>
          <li><a href=''>New Arrivals</a></li>
          <li><a href=''>Tops</a>
              <ul id='subclass1'>
                  <li><a href=''>All tops</a></li>
                  <li><a href=''>T-shirt</a></li>
                  <li><a href=''>Longsleeves</a></li>
                  <li><a href=''>Hoodie</a></li>
              </ul>
          </li>
          <li><a href=''>Bottoms</a>
              <ul id='subclass1'>
                  <li><a href=''>All Bottoms</a></li>
                  <li><a href=''>Shorts</a></li>
                  <li><a href=''>Pants</a></li>
                  <li><a href=''>Double Knee</a></li>
                  <li><a href=''>Jeans</a></li>
              </ul></li>
          <li><a href=''>Shoes</a>
              <ul id='subclass1'>
                  <li><a href=''>All shoes</a></li>
                  <li><a href=''>Running Shoes</a></li>
                  <li><a href=''>Casual Shoes</a></li>
              </ul></li>
          <li><a href=''>Accessories</a>
              <ul id='subclass1'>
                  <li><a href=''>All Accessories</a></li>
                  <li><a href=''>Caps</a></li>
                  <li><a href=''>Glasses</a></li>
              </ul></li>           
      </ul>
  </div>
  ";
}
else {
  echo "

                        <nav class ='topnav'>
                            <label class='title'>Tiago's Vintage</label>
                            <img class='logo' src='../assets/tiagos-removebg-preview 1.png' alt=''>
                                <ul>
                                    <li><a href='landing.php'>Home</a></li>
                                    <li><a href=''>New arrivals</a></li>
                                    <li><a href='productList.php'>Tops</a></li>
                                    <li><a href='productList.php'>Bottom</a></li>
                                    <li><a href='productList.php'>Shoes</a></li>
                                    <li><a href='productList.php'>Accessories</a></li>
                                    <li><a href=''>Reviews</a></li>
                                    <li><img class='search' src='../assets/Search.png' alt=''></li>
                                    <li><img class='shopping' src='../assets/Shopping Cart.png' alt=''></li>
                                    <li><a href=''>Register/Login</a></li>
                                </ul>
                        </nav>
";
}
?>

<script>

document.addEventListener('DOMContentLoaded', () => {
    // Functions to open and close a modal
    function openModal($el) {
      $el.classList.add('is-active');
    }
  
    function closeModal($el) {
      $el.classList.remove('is-active');
    }
  
    function closeAllModals() {
      (document.querySelectorAll('.modal') || []).forEach(($modal) => {
        closeModal($modal);
      });
    }
  
    // Add a click event on buttons to open a specific modal
    (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
      const modal = $trigger.dataset.target;
      const $target = document.getElementById(modal);
  
      $trigger.addEventListener('click', () => {
        closeAllModals();
        openModal($target);
      });
    });
  
    // Add a click event on various child elements to close the parent modal
    (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
      const $target = $close.closest('.modal');
  
      $close.addEventListener('click', () => {
        closeModal($target);
      });
    });
  
    // Add a keyboard event to close all modals
    document.addEventListener('keydown', (event) => {
      if(event.key === "Escape") {
        closeAllModals();
      }
    });
  });









  document.addEventListener('DOMContentLoaded', () => {
    // Functions to open and close a modal
    function openModal($el) {
      $el.classList.add('is-active');
    }
  
    function closeModal($el) {
      $el.classList.remove('is-active');
    }
  
    function closeAllModals() {
      (document.querySelectorAll('.modal') || []).forEach(($modal) => {
        closeModal($modal);
      });
    }
  
    // Add a click event on buttons to open a specific modal
    (document.querySelectorAll('.js-modal-trigger-sign-up') || []).forEach(($trigger) => {
      const modal = $trigger.dataset.target;
      const $target = document.getElementById(modal);
  
      $trigger.addEventListener('click', () => {
        closeAllModals();
        openModal($target);
      });
    });
  
    // Add a click event on various child elements to close the parent modal
    (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
      const $target = $close.closest('.modal');
  
      $close.addEventListener('click', () => {
        closeModal($target);
      });
    });
  
    // Add a keyboard event to close all modals
    document.addEventListener('keydown', (event) => {
      if(event.key === "Escape") {
        closeAllModals();
      }
    });
  });
          
</script>
