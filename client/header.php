

<!DOCTYPE html>
<html lang="en"  data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/product.css">
    <title>Tiago's Vintage</title>
</head>
<body>

<style>

:root {
  --bulma-primary-h: 120;
  --bulma-primary-s: 100%;
  --bulma-primary-l: 16%;
  --bulma-link-h: 120;
  --bulma-link-s: 92%;
  --bulma-link-l: 57%;
}

.navbar img {
    max-height: 8rem; 
    padding: -10px
}

.navbar-item{
    color: white;
    border-radius: 70px;
    
}

.navbar{
    font-family: 'Gill Sans MT';
    font-size: 18px;
    
    align-items: center;
    background-color: hsl(93, 100%, 9%);
    
    color: green;
}

.navbar-item:hover {
    background-color: green;
    border-radius: 70px;
    background-color: hsl(93, 100%, 20%);
}
/* drowdown style */
.dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            min-width: 160px;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        /* Show the dropdown when the person icon is clicked */
        .dropdown:hover .dropdown-content {
            display: block;
        }


</style>



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
            <a href='#'>Log Out</a>
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
            <a class='navbar-item js-modal-trigger' data-target='modal-js-example'>Register/Login</a>             
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


?>








        
        <div id="modal-js-example" class="modal">
        <div class="modal-background ">

        </div>
      
        <div class="modal-content">
          <div class="box has-background-primary">
            <div class="form">
                <p class="has-text-centered title is-size-2 has-text-white">Login</p>
<form action="./includes/login.php" method="post">



               <div class="field">
                    <div class="control">
                    <label for="username" class="has-text-white">Username</label>
                    <input type="text" class = "input" id="username" name="username" placeholder="Enter Username">
                    </div>
                </div>
                
                <div class="field">
                    <div class="control">
                    <label for="password" class="has-text-white">Password</label>
                    <input type="password" class = "input" id="password" name="password" placeholder="Enter Password">
                    </div>
                </div>


               <div class="field">
                    <div class="control has-text-centered">
                        <button type="Login" name="Login" class="button">Login</button>
                    </div>
               </div>
                
                <div class="form-element has-text-centered" >
                    <a class="js-modal-trigger" data-target="modal-js-example-sign-up">Does not have an account yet? Register here</a>
                </div>

            </div>
            </form>
            
          </div>
        </div>
      
        <button class="modal-close is-large" aria-label="close"></button>
      </div>








      <div id="modal-js-example-sign-up" class="modal">
        <div class="modal-background ">

        </div>
      
        <div class="modal-content">
          <div class="box has-background-primary">
            <div class="form">
                <p class="has-text-centered title is-size-2 has-text-white">Register</p>
<form action="./includes/register.php" method="post">

                <div class="field">
                    <div class="control">
                        <label for="fName" class="has-text-white">First Name</label>
                        <input type="text" class = "input" id="fName" name="firstName" placeholder="Enter First name">
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label for="lName" class="has-text-white">Last Name</label>
                        <input type="text" class = "input" id="lName" name="lastName" placeholder="Enter Last name">
                    </div>
                </div>

               <div class="field">
                    <div class="control">
                    <label for="username" class="has-text-white">Username</label>
                    <input type="text" class = "input" id="username" name="username" placeholder="Enter Username">
                    </div>
                </div>
                
                <div class="field">
                    <div class="control">
                    <label for="password" class="has-text-white">Password</label>
                    <input type="password" class = "input" id="password" name="password" placeholder="Enter Password">
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                    <label for="password" class="has-text-white">Confirm Password</label>
                    <input type="password" class = "input" id="password" name="ConfPassword" placeholder="Confirm Password">
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                    <label for="contact" class="has-text-white">Contact#</label>
                    <input type="tel" class = "input" id="contact" name="contact" placeholder="Enter Contact number">
                    </div>
                </div>

               <div class="field">
                    <div class="control has-text-centered">
                        <button type="register" name="register" class="button">Register</button>
                    </div>
               </div>
                
                <div class="form-element has-text-centered" >
                    <a class="js-modal-trigger" data-target="modal-js-example">Already have an account? Click here to Log in </a>
                </div>

            </div>
            </form>
            
          </div>
        </div>
      
        <button class="modal-close is-large" aria-label="close"></button>
      </div>

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
