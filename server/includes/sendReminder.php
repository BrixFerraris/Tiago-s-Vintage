<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; 
include_once './dbCon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transactionId = isset($_POST['transaction_id']) ? $_POST['transaction_id'] : ''; 

    if ($transactionId > 0) {
        $sql = "SELECT st.*, u.firstName, u.username
                FROM tbl_transactions st
                INNER JOIN tbl_users u ON st.user_id = u.id
                WHERE st.transaction_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $transactionId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $appointment = $result->fetch_assoc();
            $email = $appointment['username'];
            $username = $appointment['firstName'];
            $transOrder = $appointment['transaction_id'];
            $status = $appointment['status'];

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.gmail.com';                   
                $mail->SMTPAuth   = true;                                  
                $mail->Username   = 'tiago.vintage.botique@gmail.com';           
                $mail->Password   = 'liubkkcavxfbdlve';              
                $mail->SMTPSecure = 'ssl';     
                $mail->Port       = 465; 

                $mail->setFrom('tiago.vintage.botique@gmail.com', 'Tiago\'s Vintage Botique');
                $mail->addAddress($email, $username);

                $mail->isHTML(true);
                $mail->Subject = 'Order Update Status';
                $mail->Body = "
                    <p>Hi $username!</p>
                    <p>This is to inform you that your order:<strong> $transOrder </strong> is $status</p>
                    <p>Thank you for supporting us in our business!</p>
                    <p>Best regards,<br>Tiago\'s Vintage Botique</p>
                ";

                $mail->send();

                echo json_encode(['status' => true]);
            } catch (Exception $e) {
                echo json_encode(['status' => false, 'error' => $mail->ErrorInfo]);
            }
        } else {
            echo json_encode(['status' => false, 'error' => 'Appointment not found']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => false, 'error' => 'Invalid appointment ID or transaction ID']);
    }
} else {
    echo json_encode(['status' => false, 'error' => 'Invalid request method']);
}

$conn->close();