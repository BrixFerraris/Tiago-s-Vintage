<?php
include './header.php';
?>

<style>
  body {
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
  }

  .box {
    margin: 20px auto;
    padding: 20px;
    max-width: 1200px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .fixed-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    justify-content: center;
  }

  .cell {
    max-width: 300px;
    margin: 0 auto;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .cell img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .cell:hover img {
    transform: scale(1.1);
  }

  .cell p {
    padding: 15px;
  }

  .cell .has-text-primary {
    color: #28a745;
  }

  .cell .has-text-weight-bold {
    font-weight: bold;
  }
</style>

<div class="box">
  <div class="fixed-grid">
    <div class="cell">
    <a href="../client/item.php">
      <img src="../images/bg.png" alt="Sample Product">
      <p>
        <span class="has-text-primary has-text-weight-bold">Sample Product</span><br>
        <span class="has-text-primary">PHP 999.00</span>
      </p>
      </a>
    </div>
  
    <div class="cell">
    <a href="../client/item.php">
      <img src="../images/bg.png" alt="Sample Product">
      <p>
        <span class="has-text-primary has-text-weight-bold">Sample Product</span><br>
        <span class="has-text-primary">PHP 999.00</span>
      </p>
      </a>
    </div>

    <div class="cell">
      <img src="../images/bg.png" alt="Sample Product">
      <p>
        <span class="has-text-primary has-text-weight-bold">Sample Product</span><br>
        <span class="has-text-primary">PHP 999.00</span>
      </p>
    </div>

    <div class="cell">
      <img src="../images/bg.png" alt="Sample Product">
      <p>
        <span class="has-text-primary has-text-weight-bold">Sample Product</span><br>
        <span class="has-text-primary">PHP 999.00</span>
      </p>
    </div>

    <div class="cell">
      <img src="../images/bg.png" alt="Sample Product">
      <p>
        <span class="has-text-primary has-text-weight-bold">Sample Product</span><br>
        <span class="has-text-primary">PHP 999.00</span>
      </p>
    </div>

    <div class="cell">
      <img src="../images/bg.png" alt="Sample Product">
      <p>
        <span class="has-text-primary has-text-weight-bold">Sample Product</span><br>
        <span class="has-text-primary">PHP 999.00</span>
      </p>
    </div>

    <div class="cell">
      <img src="../images/bg.png" alt="Sample Product">
      <p>
        <span class="has-text-primary has-text-weight-bold">Sample Product</span><br>
        <span class="has-text-primary">PHP 999.00</span>
      </p>
    </div>

    <div class="cell">
      <img src="../images/bg.png" alt="Sample Product">
      <p>
        <span class="has-text-primary has-text-weight-bold">Sample Product</span><br>
        <span class="has-text-primary">PHP 999.00</span>
      </p>
    </div>

    <div class="cell">
      <img src="../images/bg.png" alt="Sample Product">
      <p>
        <span class="has-text-primary has-text-weight-bold">Sample Product</span><br>
        <span class="has-text-primary">PHP 999.00</span>
      </p>
    </div>
  </div>
</div>

<?php
include 'footer.php';
?>
