<?php
include_once 'dbCon.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminId = intval($_POST['adminId']);
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $role = $_POST['role'];
    $username = $_POST['uName'];
    $password = $_POST['pWord'];
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE tbl_users SET firstName = ?, lastName = ?, role = ?, username = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $firstName, $lastName, $role, $username, $hashedPassword, $adminId);
    } else {
        $query = "UPDATE tbl_users SET firstName = ?, lastName = ?, role = ?, username = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $firstName, $lastName, $role, $username, $adminId);
    }
    if ($stmt->execute()) {
        header("Location: ../superadmin_AdminProfile.php?error=none");
        exit(); 
    } else {
        header("Location: ../superadmin_AdminProfile.php?error=FailedUpdate");
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../superadmin_AdminProfile.php?error=FailedUpdate");
}