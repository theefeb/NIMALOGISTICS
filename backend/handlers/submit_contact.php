<?php
// Simple contact form handler using PHP mail() function
// No external dependencies required

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
    
    // Email notification using PHP mail() function
    $to = "febianfebb069@gmail.com"; // Testing email address
    $subject = "New Contact Message from NIMA Logistics Website";
    
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
            <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Message:</strong></p>
            <p>" . nl2br(htmlspecialchars($message)) . "</p>
            <hr>
            <p><small>This message was sent from the NIMA Logistics contact form.</small></p>
        </body>
        </html>
    ";
    
    // Send email
    $email_sent = mail($to, $subject, $email_body, implode("\r\n", $headers));
    
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