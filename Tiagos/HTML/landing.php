<?php

include_once 'header.php';
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>landing</title>
</head>
<body>

    <div class="slider">
        <div class="slide fade in">
            <img src="../images/bg1.png" alt="Slide 1">
        </div>
        <div class="slide fade">
            <img src="../images/bg2.png" alt="Slide 2">
        </div>
        <div class="slide fade">
            <img src="../images/bg3.png" alt="Slide 3">
        </div>
    </div>

    <script>
        let slides = document.querySelectorAll('.slide');
        let currentIndex = 0;
        let slideInterval = 5000; // 5 seconds

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('in');
                if (i === index) {
                    slide.classList.add('in');
                }
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        showSlide(currentIndex); // Show the first slide initially
        setInterval(nextSlide, slideInterval); // Change slide every 5 seconds
    </script>

</body>
</html>

<?php
include_once 'footer.php';
?>