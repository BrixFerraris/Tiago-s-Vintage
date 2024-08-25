<?php
include 'header.php';
?>

<style>
  body {
    background-color: #f4f4f4;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
  }

  .container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 50px auto;
    gap: 30px;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .box {
    flex: 1;
    max-width: 550px;
    box-sizing: border-box;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
  }

  .box h1 {
    font-family: 'Times New Roman', serif;
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
  }

  .box h2 {
    font-family: 'Arial', sans-serif;
    font-size: 28px;
    margin-bottom: 20px;
    color: #333;
  }

  .box p {
    font-family: 'Arial', sans-serif;
    font-size: 18px;
    margin-bottom: 20px;
    color: #666;
  }

  .box li {
    font-family: 'Arial', sans-serif;
    font-size: 18px;
    color: #808080;
    margin-bottom: 10px;
  }

  .image1 img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }

  .haha {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }

  .haha figure {
    flex: 1;
    margin: 0 5px;
  }

  .haha img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .haha img:hover {
    transform: scale(1.1);
  }

  .button {
    font-family: 'Arial', sans-serif;
    font-size: 18px;
    color: white;
    background-color: hsl(93, 100%, 20%);
    border: none;
    padding: 10px 20px;
    margin: 10px 0;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
  }

  .button:hover {
    background-color: hsl(93, 100%, 20%);
  }

  #add-to-cart {
    width: 100%;
    text-align: center;
  }
</style>

<div class="container">

    <!-- Product Images Section -->
    <form class="box" id="box1">
      <figure class="image1">
        <img src="../images/sample-item.png" alt="Main product image" />
      </figure>

      <div class="haha">
        <figure>
          <img src="../images/sample-item.png" alt="Additional product image 1" />
        </figure>
        <figure>
          <img src="../images/sample-item.png" alt="Additional product image 2" />
        </figure>
        <figure>
          <img src="../images/sample-item.png" alt="Additional product image 3" />
        </figure>
      </div>
    </form>

    <!-- Product Details Section -->
    <form class="box">
      <h1>Sample Product</h1>
      <h2>PHP 999.99</h2>
      <p>Select Size:</p>

      <button class="button" id="button1">Size 1</button>
      <button class="button" id="button2">Size 2</button>

      <ul>
        <li>High-quality material and durable stitching.</li>
        <li>Available in multiple sizes and colors.</li>
      </ul>

      <button class="button" id="add-to-cart">Add To Cart</button>
    </form>

</div>

<script>
  document.getElementById('button1').addEventListener('click', function() {
    document.getElementById('button2').disabled = true;
    this.classList.toggle('active');
  });

  document.getElementById('button2').addEventListener('click', function() {
    document.getElementById('button1').disabled = true;
    this.classList.toggle('active');
  });
</script>

<?php
include 'footer.php';
?>
