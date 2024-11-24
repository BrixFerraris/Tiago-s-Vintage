<?php
require_once './functions.php';
require_once './dbCon.php';
if (isset($_POST["register"])) {
    $Fname = $_POST["firstName"];
    $Lname = $_POST["lastName"];
    $UserName = $_POST["email"];
    $password = $_POST["password"];
    $ConfPassword = $_POST["ConfPassword"];
    $contact = $_POST["contact"];

    if (emptyInputSignup($Fname,$Lname,$contact,$UserName,$password,$ConfPassword) !== false) {
        header("location: ../register.php?error=EmptyInput");
        exit();
    }
    if (passMatch($password,$ConfPassword) !==false) {
        header("location: ../register.php?error=PassNotMatching");
        exit();
    }
    if (userExist($conn,$UserName) !== false) {
        header("location: ../register.php?error=UsernameTaken");
        exit();
    }
    createUser($conn,$UserName,$Lname,$Fname,$contact,$ConfPassword);
} elseif (isset($_POST["admin"])) {
    $Fname = $_POST["firstName"];
    $Lname = $_POST["lastName"];
    $UserName = $_POST["email"];
    $password = $_POST["password"];
    $adminRole = $_POST["adminRole"];
    $contact = 'None';
    if (empty($Fname) || empty($Lname) || empty($UserName) || empty($password)) {
        header("location: ../../server/superadmin_AdminProfile.php?error=EmptyInput");
        exit();
    }
    if (!preg_match("/^[a-zA-Z0-9]*$/", $UserName)) {
        header("location: ../../server/superadmin_AdminProfile.php?error=InvalidUsername");
        exit();
    }
    $sql = "SELECT * FROM tbl_users WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../server/superadmin_AdminProfile.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $UserName);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($resultData)) {
        header("location: ../../server/superadmin_AdminProfile.php?error=UsernameTaken");
        exit();
    }
    
    mysqli_stmt_close($stmt);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO tbl_users (username, password, firstName, lastName, contact, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../server/superadmin_AdminProfile.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssss", $UserName, $hashedPassword, $Fname, $Lname, $contact, $adminRole);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../../server/superadmin_AdminProfile.php?error=none");
    exit();
} else {
    header("../../server/superadmin_AdminProfile.php?Error");
    exit();
}