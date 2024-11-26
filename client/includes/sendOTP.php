<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; 

function generateOTP($length = 6) {
    unset($_SESSION['otp']);
    return rand(100000, 999999); 
}

function sendOTP($email, $otp) {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                   
        $mail->SMTPAuth   = true;                                  
        $mail->Username   = 'tiagos.vintage.botique@gmail.com';           
        $mail->Password   = 'mojjwqlxnifwrfmn';              
        $mail->SMTPSecure = 'ssl';     
        $mail->Port       = 465;   
        $mail->Priority = 1;                                

        $mail->setFrom('tiagos.vintage.botique@gmail.com', 'Tiago\'s Vintage Botique');
        $mail->addAddress($email);                                 
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "
          <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;'>
            <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);'>
              <div style='background-color: #4CAF50; color: white; text-align: center; padding: 20px; font-size: 24px; font-weight: bold; border-radius: 8px 8px 0 0;'>
                Your OTP Code
              </div>
              <div style='text-align: center; padding: 20px; color: #333333;'>
                <p style='font-size: 18px;'>Hello,</p>
                <p style='font-size: 16px;'>Your OTP code is:</p>
                <div style='font-size: 28px; font-weight: bold; color: #4CAF50; padding: 10px 20px; margin: 20px 0; display: inline-block; border-radius: 5px; border: 2px solid #4CAF50;'>
                  <b>$otp</b>
                </div>
                <p style='font-size: 16px;'>Please enter this code to complete your verification.</p>
                <p style='font-size: 14px; color: #777777;'>If you did not request this code, please ignore this email.</p>
              </div>
              <div style='text-align: center; padding: 10px; background-color: #f1f1f1; font-size: 12px; color: #777777;'>
                <p>Thank you for using our service!</p>
              </div>
            </div>
          </div>
        ";
        

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $otp = generateOTP();
    $_SESSION['otp'] = $otp;
    if (sendOTP($email, $otp)) {
        echo json_encode(['success' => true, 'message' => 'OTP sent to your email.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send OTP.']);
    }
}