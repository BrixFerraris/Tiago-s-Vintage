<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_otp = $_POST['otp'];

    if (isset($_SESSION['otp']) && $entered_otp == $_SESSION['otp']) {
        unset($_SESSION['otp']); 
        echo json_encode(array("status" => "success", "message" => "OTP verified successfully!"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Invalid OTP. Please try again."));
    }
}