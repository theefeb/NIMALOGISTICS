<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include Composer autoloader for PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Log the form submission
error_log("Contact form submitted at: " . date('Y-m-d H:i:s'));

$host = "localhost";
$user = "root";
$pass = "";
$db = "nima_logistics";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

error_log("Form data received - Name: $name, Email: $email, Message: " . substr($message, 0, 50) . "...");

if ($name && $email && $message) {
    // Save to database
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $db_success = $stmt->execute();
    $stmt->close();
    
    error_log("Database save result: " . ($db_success ? "SUCCESS" : "FAILED"));
    
    // Include email configuration
    require_once 'email_config.php';
    
    // Email notification using PHPMailer with SMTP
    $mail = new PHPMailer(true);
    
    try {
        error_log("Starting email sending process...");
        
        // Server settings for Gmail SMTP
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = SMTP_PORT;
        
        // Enable debug output
        $mail->SMTPDebug = 0; // Set to 2 for detailed debug output
        
        // Recipients - The sender is the person filling out the form
        $mail->setFrom(SMTP_USERNAME, 'NIMA Logistics Website');  // Use your Gmail as the sending account
        $mail->addAddress(RECIPIENT_EMAIL, RECIPIENT_NAME);  // Send to your email
        
        // Set reply-to to the visitor's email so you can reply directly
        $mail->addReplyTo($email, $name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Message from ' . $name;
        $mail->Body    = "
            <h2>New Contact Form Submission</h2>
            <p><strong>From:</strong> {$name} ({$email})</p>
            <p><strong>Message:</strong></p>
            <p>" . nl2br(htmlspecialchars($message)) . "</p>
            <hr>
            <p><small>This message was sent from the NIMA Logistics contact form.</small></p>
            <p><small>Click 'Reply' to respond directly to {$name}.</small></p>
        ";
        $mail->AltBody = "
            New Contact Form Submission
            
            From: {$name} ({$email})
            Message: {$message}
            
            This message was sent from the NIMA Logistics contact form.
            Reply to this email to respond to {$name}.
        ";
        
        error_log("Attempting to send email...");
        $mail->send();
        $email_sent = true;
        error_log("Email sent successfully!");
        
    } catch (Exception $e) {
        $email_sent = false;
        $error_message = "PHPMailer Error: {$mail->ErrorInfo}";
        error_log($error_message);
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
    error_log("Form validation failed - missing required fields");
    echo "Please fill in all fields.";
}
$conn->close();
?> 