<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';


function sendMail($subject, $message, $receiver_email, $receiver_name)
{
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);


    try {
        //Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'in-v3.mailjet.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'e2af1826a89f663284b9d9983c04463e';                     // SMTP username
        $mail->Password   = '50ba8da9112f15ce4d6a334d5e57bae5';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('Jh913427@gmail.com', 'Online Certificate-System');

        $mail->addAddress($receiver_email, '');     // Add a recipient


        $body = "<p><strong>Hello $receiver_name,</strong><br>$message</p><br>Thank You";


        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        if ($mail->send()) {
            echo 'Message has been sent';
            return true;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}