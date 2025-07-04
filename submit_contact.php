<?php
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
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();
    $stmt->close();
    // Email notification
    $to = "your@email.com"; // TODO: Change to your real email
    $subject = "New Contact Message";
    $message_body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: noreply@nima.co.ke\r\n";
    // For production, consider using SMTP/PHPMailer for reliability
    mail($to, $subject, $message_body, $headers);
    echo "Message sent successfully!";
} else {
    echo "Please fill in all fields.";
}
$conn->close();
?> 