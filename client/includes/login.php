<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST["Login"])) {
    $uName = $_POST["username"];
    $pwd = $_POST["password"];
    echo "Login button clicked"; 
    require_once('./functions.php');
    require_once('./dbCon.php');

    if (emptyInputLogin($uName,$pwd) !== false) {
        header("location: ../landing.php?error=EmptyInput");
        exit();
    }

    loginUser($conn, $uName, $pwd);
    echo "User logged in";
}