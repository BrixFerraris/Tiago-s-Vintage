<?php

include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tiago's Vintage</title>
  <style>

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #228B22; /* Dark Green Background */
      color: #fff; /* White text */
    }

    header {
      background-color: #228B22;
      padding: 10px 0;
      text-align: center;
    }

    .logo {
      display: inline-block;
      width: 100px;
      height: 100px;
      background-image: ("tiagos.png"); /* Replace with your logo */
      background-size: cover;
      margin-right: 20px;
    }

    nav {
      background-color: #228B22;
      padding: 10px 0;
      text-align: center;
    }

    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    nav li {
      display: inline-block;
      margin: 0 10px;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      padding: 5px 10px;
      border-bottom: 2px solid transparent; /* Add a border that appears on hover */
      transition: border-bottom-color 0.3s ease; /* Smooth transition */
    }

    nav a:hover {
      border-bottom-color: #fff; /* White border on hover */
    }

    .container {
      width: 80%;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff; /* White content background */
      color: #228B22; /* Dark Green text */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    .customer-reviews {
      background-color: #f2f2f2; /* Light Grey background */
      padding: 20px;
      margin-top: 20px;
    }

    .review-form {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    textarea {
      width: 100%;
      height: 150px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      resize: vertical;
    }

    .rating {
      margin-top: 10px;
    }

    .submit-button {
      background-color: #228B22;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    footer {
      background-color: #228B22;
      padding: 20px 0;
      text-align: center;
    }

    footer a {
      color: #fff;
      text-decoration: none;
      margin: 0 10px;
    }

    .social-icons {
      margin-top: 10px;
    }

    .social-icons i {
      font-size: 24px;
      color: #fff;
      margin: 0 5px;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo"></div>
    <h1>Tiago's Vintage</h1>
  </header>
<nav>
  <div class="container">
    <h2>Customer Reviews</h2>
    <div class="customer-reviews">
      <div class="review-form">
        <textarea placeholder="Write your review here..."></textarea>
        <div class="rating">
          Rating:
          <select>
            <option value="5">5 Stars</option>
            <option value="4">4 Stars</option>
            <option value="3">3 Stars</option>
            <option value="2">2 Stars</option>
            <option value="1">1 Star</option>
          </select>
        </div>
        <button class="submit-button">Submit Review</button>
      </div>
    </div>
  </div>

  <footer>
    <div class="social-icons">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
    <p>&copy; 2024 Tiago's Vintage. All rights reserved.</p>
  </footer>

  <script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script> </body>
</html>