<?php
if (isset($_POST["register"])) {
    $Fname = $_POST["firstName"];
    $Lname = $_POST["lastName"];
    $UserName = $_POST["username"];
    $password = $_POST["password"];
    $ConfPassword = $_POST["ConfPassword"];
    $contact = $_POST["contact"];

    require_once './functions.php';
    require_once './dbCon.php';

    if (emptyInputSignup($Fname,$Lname,$contact,$UserName,$password,$ConfPassword) !== false) {
        header("location: ./landing.php?error=EmptyInput");
        exit();
    }
    if (passMatch($password,$ConfPassword) !==false) {
        header("location: ./landing.php?error=PassNotMatching");
        exit();
    }
    if (InvalidUser($UserName) !== false) {
        header("location: ./landing.php?error=InvalidUsername");
        exit();
    }
    if (userExist($conn,$UserName) !== false) {
        header("location: ./landing.php?error=UsernameTaken");
        exit();
    }
    createUser($conn,$UserName,$Lname,$Fname,$contact,$ConfPassword);
}
else {
    header("location: ../landing.php?Error");
    exit();
}