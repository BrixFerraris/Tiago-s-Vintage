<?php
include 'header.php';
?>          


<head>
    <link rel="stylesheet" href="../CSS/contactUs.css">
</head>

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

