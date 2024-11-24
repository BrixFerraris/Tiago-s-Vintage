<?php
session_start();
include_once './dbCon.php';

if (isset($_POST['username']) && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['contact'])) {
    $userId = $_SESSION['uID'];
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("UPDATE tbl_users SET username = ?, firstName = ?, lastName = ?, contact = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $username, $firstName, $lastName, $contact, $userId);

    if ($stmt->execute()) {
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $updatePasswordStmt = $conn->prepare("UPDATE tbl_users SET password = ? WHERE id = ?");
            $updatePasswordStmt->bind_param("si", $hashedPassword, $userId);
            $updatePasswordStmt->execute();
            $updatePasswordStmt->close();
        }
        echo json_encode(['message' => 'User  information updated successfully.']);
    } else {
        echo json_encode(['message' => 'Error updating user information.']);
    }

    $stmt->close();
} else {
    echo json_encode(['message' => 'Invalid input.']);
}
$conn->close();