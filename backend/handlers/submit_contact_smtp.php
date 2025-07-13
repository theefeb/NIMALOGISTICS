<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Simple contact form handler using PHP mail() function
// No external dependencies required

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
    
    // Email notification using PHP mail() function
    $to = "info@nimalogistics.com"; // Replace with your email
    $subject = "New Contact Message from " . $name;
    
    // Email headers
    $headers = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-Type: text/html; charset=UTF-8";
    $headers[] = "From: NIMA Logistics Website <noreply@nimalogistics.com>";
    $headers[] = "Reply-To: {$email}";
    $headers[] = "X-Mailer: PHP/" . phpversion();
    
    // Email body
    $email_body = "
        <html>
        <head>
            <title>New Contact Form Submission</title>
        </head>
        <body>
            <h2>New Contact Form Submission</h2>
            <p><strong>From:</strong> " . htmlspecialchars($name) . " (" . htmlspecialchars($email) . ")</p>
            <p><strong>Message:</strong></p>
            <p>" . nl2br(htmlspecialchars($message)) . "</p>
            <hr>
            <p><small>This message was sent from the NIMA Logistics contact form.</small></p>
            <p><small>Click 'Reply' to respond directly to " . htmlspecialchars($name) . ".</small></p>
        </body>
        </html>
    ";
    
    error_log("Attempting to send email...");
    
    // Send email
    $email_sent = mail($to, $subject, $email_body, implode("\r\n", $headers));
    
    if ($email_sent) {
        error_log("Email sent successfully!");
    } else {
        error_log("Email sending failed!");
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