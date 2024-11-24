<?php
include 'header.php';
?>          

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiago's Vintage</title>
    <link rel="stylesheet" href="../CSS/contactUs.css">
</head>
<body>
    <main>
        <section class="contact-form-section">
            <form class="contact-form">
                <h2>Contact Form</h2>
                <div class="form-group">
                    <label for="full-name">Full name:</label>
                    <input type="text" id="full-name" name="full_name" placeholder="Your full name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Your email">
                </div>
                <div class="form-group">
                    <label for="concern">Concern:</label>
                    <input type="text" id="concern" name="concern" placeholder="Subject or concern">
                </div>
                <div class="form-group">
                    <label for="message">Comment or message:</label>
                    <textarea id="message" name="message" placeholder="Write your message here"></textarea>
                </div>
                <button type="submit" class="submit-button">Submit</button>
            </form>
        </section>
    </main>
</body>
</html>
