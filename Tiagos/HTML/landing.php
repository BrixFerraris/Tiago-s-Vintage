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
        <div id="img">
             <img src="../images/bg.png"/>
         </div>
    </div>

<script>
    
var img = document.getElementById('img');
var slides=['../images/bg1.png','../images/bg2.png','../images/bg3.png'];
var Start=0;

function slider(){
    if(Start<slides.length){
        Start=Start+1;
    }
    else{
        Start=1;
    }
    img.classList.add('slide-out');
    setTimeout(function(){
        img.innerHTML = "<img src="+slides[Start-1]+">";
        img.classList.remove('slide-out');
        img.classList.add('slide-in');
    }, 500);
    setTimeout(function(){
        img.classList.remove('slide-in');
    }, 1500);
}
setInterval(slider, 5000);
</script>

</body>
</html>

<?php
include_once 'footer.php'
?>