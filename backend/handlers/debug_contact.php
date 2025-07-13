<?php
// Debug script for contact form troubleshooting
echo "<h2>Contact Form Debug Information</h2>";

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h3>✅ Form Submitted Successfully</h3>";
    
    $name = $_POST['name'] ?? 'Not provided';
    $email = $_POST['email'] ?? 'Not provided';
    $message = $_POST['message'] ?? 'Not provided';
    
    echo "<p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($message) . "</p>";
    
    // Test database connection
    echo "<h3>Database Connection Test</h3>";
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "nima_logistics";
    
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        echo "<p style='color: red;'>❌ Database connection failed: " . $conn->connect_error . "</p>";
    } else {
        echo "<p style='color: green;'>✅ Database connection successful</p>";
        
        // Test inserting into database
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $name, $email, $message);
            if ($stmt->execute()) {
                echo "<p style='color: green;'>✅ Message saved to database successfully</p>";
            } else {
                echo "<p style='color: red;'>❌ Failed to save message to database: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p style='color: red;'>❌ Failed to prepare database statement</p>";
        }
    }
    $conn->close();
    
    // Test email functionality
    echo "<h3>Email Functionality Test</h3>";
    
    $to = "info@nimalogistics.com"; // Replace with your email
    $subject = "Debug Test - Contact Form";
    
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
            <title>Debug Test Email</title>
        </head>
        <body>
            <h2>Debug Test Email</h2>
            <p>This is a test email from the contact form debug script.</p>
            <p><strong>Test Data:</strong></p>
            <p>Name: " . htmlspecialchars($name) . "</p>
            <p>Email: " . htmlspecialchars($email) . "</p>
            <p>Message: " . htmlspecialchars($message) . "</p>
        </body>
        </html>
    ";
    
    // Test PHP mail() function
    $email_sent = mail($to, $subject, $email_body, implode("\r\n", $headers));
    
    if ($email_sent) {
        echo "<p style='color: green;'>✅ Test email sent successfully using PHP mail()!</p>";
    } else {
        echo "<p style='color: red;'>❌ Email sending failed using PHP mail()</p>";
        echo "<p><small>Note: PHP mail() function may not work on all servers. For production, consider using a proper SMTP service.</small></p>";
    }
    
} else {
    echo "<h3>No Form Submission Detected</h3>";
    echo "<p>This debug script should be called when a form is submitted.</p>";
    echo "<p>To test the contact form, go to your website and submit a message.</p>";
}

echo "<h3>Quick Links</h3>";
echo "<p><a href='../../pages/index.html' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>← Back to Website</a></p>";
echo "<p><a href='../tests/test_email_send.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🧪 Send Test Email</a></p>";
?> 