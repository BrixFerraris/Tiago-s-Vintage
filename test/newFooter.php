<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="../test/newFooter.css">
    <title>Footer Design</title>
</head>

<body>
    <footer>
        <div class="footer-info">
            <span>Tiago's Vintage Boutique:</span>

        </div>
        <div class="footer-container">
            <div class="rows">
                <div class="row1"><img class="logo" src="../assets/tiagos-removebg-preview 1.png" alt="">
                    <p id="about">Tiago's Vintage provides a seamless online shopping experience for vintage
                        enthusiasts, offering
                        a carefully curated selection of timeless pieces. With an intuitive interface and smooth
                        navigation, it ensures that finding and purchasing unique items is both enjoyable and
                        effortless.</p>
                </div>
                <div class="row3">
                    <h3>ADDRESS:</h3>
                    <p id="address"><i class="fas fa-location"></i> Bayan Luma, Imus City, Cavite</p>

                </div>
                <div class="row4">
                    <h3>CONTACT US:</h3>
                    <p><a id="fb" href="" target="_blank" style="text-decoration: none; color:white"> Tiago's Vintage</a></p>
                    <p><a id="ig" href="" target="_blank" style="text-decoration: none; color:white"> tiagos_vintage_</a></p>
                    <p><a id="email" href="" style="text-decoration: none; color:white"> TiagosVintage@gmail.com</a></p>
                    <p id="contact">0995 795 6315</p>

                </div>
                <style>
                    .mapouter {
                        position: relative;
                        width: 600px;
                        height: 350px;
                    }

                    .gmap_canvas {
                        overflow: hidden;
                        background: none !important;
                        width: 80%;
                        height: 80%;
                    }

                    .gmap_iframe {
                        width: 80% !important;
                        height: 80% !important;
                    }
                </style>
            </div>
        </div>
        </div>
        <div class="footer-bottom">
            <p style="color:white;">© 2024 Copyright:
                <a href="http://localhost/tiago/client/landing.php">tiago-vintage.helioho.st</a>
            </p>
        </div>
    </footer>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'http://localhost/tiago/server/includes/getCMS.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.error) {
                        console.log("CMS ERROR");
                    } else {
                        // console.log(data);
                        $('#about').text(data.about);
                        $('#address').text(data.address);
                        $('#fb').attr('href', data.fb);
                        $('#ig').attr('href', data.ig);
                        $('#contact').text(data.number);
                        $('#email').attr('href', 'mailto:' + data.email);
                        $('#email').text(data.email);
                    }
                },
                error: function () {
                    $('#cms-title').text('Error loading data');
                }
            });
        });
    </script>
</body>