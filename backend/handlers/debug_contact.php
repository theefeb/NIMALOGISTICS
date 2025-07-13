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
    
    // Test email configuration
    echo "<h3>Email Configuration Test</h3>";
    if (file_exists('email_config.php')) {
        echo "<p style='color: green;'>✅ Email configuration file found</p>";
        require_once 'email_config.php';
        
        echo "<p><strong>SMTP Host:</strong> " . SMTP_HOST . "</p>";
        echo "<p><strong>SMTP Port:</strong> " . SMTP_PORT . "</p>";
        echo "<p><strong>From Email:</strong> " . SMTP_FROM_EMAIL . "</p>";
        echo "<p><strong>To Email:</strong> " . RECIPIENT_EMAIL . "</p>";
        
        // Test PHPMailer
        if (file_exists('vendor/autoload.php')) {
            echo "<p style='color: green;'>✅ PHPMailer found</p>";
            
            require 'vendor/autoload.php';
            // PHPMailer classes are now available through autoloader
            
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_USERNAME;
                $mail->Password = SMTP_PASSWORD;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = SMTP_PORT;
                
                $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
                $mail->addAddress(RECIPIENT_EMAIL, RECIPIENT_NAME);
                $mail->addReplyTo($email, $name);
                
                $mail->isHTML(true);
                $mail->Subject = 'Debug Test - Contact Form';
                $mail->Body = "This is a debug test email from the contact form.";
                
                $mail->send();
                echo "<p style='color: green;'>✅ Test email sent successfully!</p>";
            } catch (Exception $e) {
                echo "<p style='color: red;'>❌ Email sending failed: " . $mail->ErrorInfo . "</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ PHPMailer not found</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Email configuration file not found</p>";
    }
    
} else {
    echo "<h3>No Form Submission Detected</h3>";
    echo "<p>This debug script should be called when a form is submitted.</p>";
    echo "<p>To test the contact form, go to your website and submit a message.</p>";
}

echo "<h3>Quick Links</h3>";
echo "<p><a href='index.html' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>← Back to Website</a></p>";
echo "<p><a href='test_email_send.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🧪 Send Test Email</a></p>";
?> 