<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Check if required fields are not empty
    if (!empty($name) && !empty($email) && !empty($message)) {

        // Validate email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Email configuration
            $to = "sohailshah14921@gmail.com"; // Replace with your email
            $mail_subject = "New Message from: $name - $subject";

            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);
            try {
                // SMTP configuration
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                 // Enable SMTP authentication
                $mail->Username   = 'sohailshah14921@gmail.com';        // Your Gmail email address
                $mail->Password   = 'vwzz jqdw nbfd vjgp';             // Your Gmail App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption
                $mail->Port       = 587;                                  // TCP port to connect to

                // Recipients
                $mail->setFrom($email, $name);                            // Sender's email
                $mail->addAddress('sohailshah14921@gmail.com');                                   // Add a recipient

                // Content
                $mail->isHTML(false);                                     // Set email format to plain text
                $mail->Subject = $mail_subject;
                $mail->Body    = "You have received a new message from your website contact form.\n\n" .
                                 "Here are the details:\n" .
                                 "Name: $name\n" .
                                 "Email: $email\n" .
                                 "Phone: $phone\n" .
                                 "Subject: $subject\n" .
                                 "Message:\n$message";

                // Send email
                $mail->send();
                echo "Your message has been sent successfully. We will get back to you shortly.";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            
        } else {
            echo "Invalid email format. Please enter a valid email address.";
        }
    } else {
        echo "Please fill in all the required fields (Name, Email, Message).";
    }
} else {
    echo "Form submission error. Please try again.";
}
?>