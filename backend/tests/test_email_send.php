<?php
// Test email sending with your configured credentials
require 'vendor/autoload.php';
require_once 'email_config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

echo "<h2>Testing Email Configuration</h2>";

try {
    $mail = new PHPMailer(true);
    
    // Server settings
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USERNAME;
    $mail->Password   = SMTP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = SMTP_PORT;
    
    // Recipients
    $mail->setFrom(SMTP_USERNAME, 'NIMA Logistics Website');
    $mail->addAddress(RECIPIENT_EMAIL, RECIPIENT_NAME);
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from NIMA Logistics Website';
    $mail->Body    = "
        <h2>Test Email Success!</h2>
        <p>This is a test email to verify that your contact form email configuration is working correctly.</p>
        <p><strong>Configuration Details:</strong></p>
        <ul>
            <li>SMTP Host: " . SMTP_HOST . "</li>
            <li>SMTP Port: " . SMTP_PORT . "</li>
            <li>From Email: " . SMTP_USERNAME . "</li>
            <li>To Email: " . RECIPIENT_EMAIL . "</li>
        </ul>
        <p>If you received this email, your contact form will now send emails when visitors submit messages!</p>
        <hr>
        <p><small>Sent at: " . date('Y-m-d H:i:s') . "</small></p>
    ";
    $mail->AltBody = "
        Test Email Success!
        
        This is a test email to verify that your contact form email configuration is working correctly.
        
        If you received this email, your contact form will now send emails when visitors submit messages!
        
        Sent at: " . date('Y-m-d H:i:s');
    
    $mail->send();
    echo "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
    echo "✅ <strong>Test email sent successfully!</strong><br>";
    echo "Check your email at <strong>" . RECIPIENT_EMAIL . "</strong> to confirm receipt.<br>";
    echo "Your contact form is now ready to send emails!";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
    echo "❌ <strong>Error sending test email:</strong><br>";
    echo "Mailer Error: {$mail->ErrorInfo}";
    echo "</div>";
}

echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>Check your email at <strong>" . RECIPIENT_EMAIL . "</strong> for the test message</li>";
echo "<li>If you received the test email, your contact form is ready!</li>";
echo "<li>Try submitting a message through your website's contact form</li>";
echo "<li>You should receive email notifications for all contact form submissions</li>";
echo "</ol>";

echo "<p><a href='index.html' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>← Back to Website</a></p>";
?> 