<?php
function emptyInputSignup($Fname,$Lname,$contact,$UserName,$password,$ConfPassword) {
    if (empty($Fname) || empty($Lname) || empty($contact) || empty($UserName) || empty($password) || empty($ConfPassword)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function InvalidUser($UserName) {
    if (!preg_match("/^[a-zA-Z0-9]*$/", $UserName)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function passMatch($password,$ConfPassword) {
    if ($password != $ConfPassword) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function userExist($conn,$UserName) {
    $sql = "SELECT * FROM tbl_users WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../landing.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $UserName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn,$UserName,$Lname,$Fname,$contact,$password){
    $sql = "INSERT INTO tbl_users(username, password, contact, firstName, lastName) VALUES(?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../register.php?stmtFailed");
        exit();
    }

    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $UserName, $hashedPass, $contact, $Fname, $Lname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../login.php?error=none");
    exit();
}

function emptyInputLogin($uName,$pwd) {
    if (empty($uName) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser ($conn, $uName, $pwd) {
    $UserExists = userExist($conn, $uName);

    if ($UserExists == false) {
        header("location: ../login.php?error=WrongLogin");
        exit();
    }

    $pwdHashed = $UserExists["password"];
    $checkPass = password_verify($pwd, $pwdHashed);

    if ($checkPass === false) {
        header("location: ../login.php?error=WrongLogin");
        exit();
    } else if ($checkPass === true) {
        session_start();
        $_SESSION["uID"] = $UserExists["id"]; 
        $_SESSION["username"] = $UserExists["username"];
        $_SESSION["role"] = $UserExists["role"];
        $_SESSION["firstName"] = $UserExists["firstName"];
        $_SESSION["isLoggedIn"] = true;
        $role = $_SESSION["role"];
        if ($role === 'Super Admin') {
            header("location: ../../server/adminDashboard.php");
            exit();
        } else if ($role === 'Add Product') {
            header("location: ../../server/adminDashboard.php");
            exit();
        } else if ($role === 'Accept Orders') {
            header("location: ../../server/adminDashboard.php");
            exit();
        } else if ($role === 'Change Contents') {
            header("location: ../../server/adminDashboard.php");
            exit();
        } else if ($role === 'Customer') {
            header("location: ../landing.php");
            exit();
        } else {
            header("location: ../login.php?error=UnexpectedRole");
            exit();
        }
    }
}