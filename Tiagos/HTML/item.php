<?php
include 'header.php';


?>

<style>
  body{
    background:white;
  }
  .container {
    display: flex;
    justify-content: space-between;
    flex-direction: row;
    align: center;
    gap:50px;
  }

  .box {
    margin-top:30px;
    height: 850px;
    width: 700px;
    gap:10px;
    box-sizing: border-box;
  }

  #box1 .haha{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 1px;
  }

  .box h1{
    font-family:'Time new roman';
    font-size:36px;
    font-weight: bolder;
    margin-left:30px;
    margin-top:30px;
  }

  .box h2{
    font-family:'Time new roman';
    margin-left:30px;

  }

  .box p{
    font-family:'Time new roman';
    font-size:24px;
    margin-left:30px;

  }

  .box li{
    font-family:'Time new roman';
    font-size:24px;
    color: #808080;
    margin-left:30px;

  }


  .box button {
    font-family:'Time new roman';
    font-size:24px;
    color:white;
    background-color:#152F00;
    margin: 0 auto;
    

  }
  .box #add-to-cart {
    display:flex;

  }
</style>

<div class="container" >

    <form class="box" id="box1">
      <figure class="image1">
        <img src="../images/sample-item.png" />
      </figure>

      <div class="haha">
        <figure class="image is-256x256">
          <img src="../images/sample-item.png" />
        </figure>
        <figure class="image is-256x256">
          <img src="../images/sample-item.png" />
        </figure>
        <figure class="image is-256x256">
          <img src="../images/sample-item.png" />
        </figure>
      </div>
     
        
    </form>

    <form class="box" >
      <h1>Sample Product</h1>
      <h2>PHP 999.99</h2><br><br>
      <p>Size:<br><br>

      <button class= "button" id="button1">size 1</button>
      <button class= "button" id="button2">size 2</button>
        <br><br>
      </p>

      <ul>
        <li>description</li>
        <br>
        <li>description</li>
      </ul> 
      <br><br><br><br><br><br><br><br><br>

      <button class="button" id="add-to-cart">Add To Cart</button>
    </form>

</div>





<script>
        document.getElementById('button1').addEventListener('click', function() {
            document.getElementById('button2').disabled = true;
        });

        document.getElementById('button2').addEventListener('click', function() {
            document.getElementById('button1').disabled = true;
        });
    </script>


<?php
include 'footer.php';


?>