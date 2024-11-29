<?php
include 'header.php';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

?>

<link rel="stylesheet" href="../CSS/about.css">
<div class="background">
    <img src="../assets/Component 2.png" alt="">
    <div class="txt">
        <h1 class="abt">About Us</h1>
        <br>
        <h1 class="abtTXT"> You are buying memories not only a shirt.</h1>
    </div>
</div>
</body>

</html>

<script>
    var userRole = "<?php echo $role; ?>";
    if (userRole !== 'Customer' && userRole !== '') {
        window.location.href = "../server/adminDashboard.php";
    }
</script>
<?php
include '../test/newFooter.php';
?>