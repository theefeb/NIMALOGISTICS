<?php
$host = "localhost";
$user = "root";
$pass = ""; // default for XAMPP
$db = "nima_logistics";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$details = $_POST['details'] ?? '';

if ($name && $email && $details) {
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, details) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $details);
    $stmt->execute();
    $stmt->close();
    // Email notification
    $to = "your@email.com"; // TODO: Change to your real email
    $subject = "New Booking Received";
    $message_body = "Name: $name\nEmail: $email\nDetails: $details";
    $headers = "From: noreply@nima.co.ke\r\n";
    // For production, consider using SMTP/PHPMailer for reliability
    mail($to, $subject, $message_body, $headers);
    echo "Booking submitted successfully!";
} else {
    echo "Please fill in all fields.";
}
$conn->close();
?> 