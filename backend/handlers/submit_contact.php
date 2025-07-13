<?php
// Include Composer autoloader for PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$host = "localhost";
$user = "root";
$pass = "";
$db = "nima_logistics";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if ($name && $email && $message) {
    // Save to database
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $db_success = $stmt->execute();
    $stmt->close();
    
    // Include email configuration
    require_once 'email_config.php';
    
    // Email notification using PHPMailer with SMTP
    $mail = new PHPMailer(true);
    
    try {
        // Server settings for Gmail SMTP
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = SMTP_PORT;
        
        // Recipients
        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->addAddress(RECIPIENT_EMAIL, RECIPIENT_NAME);
        $mail->addReplyTo($email, $name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Message from NIMA Logistics Website';
        $mail->Body    = "
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Message:</strong></p>
            <p>" . nl2br(htmlspecialchars($message)) . "</p>
            <hr>
            <p><small>This message was sent from the NIMA Logistics contact form.</small></p>
        ";
        $mail->AltBody = "
            New Contact Form Submission
            
            Name: {$name}
            Email: {$email}
            Message: {$message}
            
            This message was sent from the NIMA Logistics contact form.
        ";
        
        $mail->send();
        $email_sent = true;
    } catch (Exception $e) {
        $email_sent = false;
        error_log("PHPMailer Error: {$mail->ErrorInfo}");
    }
    
    if ($db_success) {
        if ($email_sent) {
            echo "Message sent successfully! We'll get back to you soon.";
        } else {
            echo "Message saved successfully! Email notification failed, but we've received your message.";
        }
    } else {
        echo "Error saving message. Please try again or contact us directly.";
    }
} else {
    echo "Please fill in all fields.";
}
$conn->close();
?> 