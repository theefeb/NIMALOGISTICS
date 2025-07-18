<?php
// Test email sending using PHP mail() function
echo "<h2>Testing Email Configuration</h2>";

// Email configuration
$to = "nimalogisticsltd@gmail.com"; // Updated email
$subject = "Test Email from NIMA Logistics Website";

// Email headers
$headers = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-Type: text/html; charset=UTF-8";
$headers[] = "From: NIMA Logistics Website <nimalogisticsltd@gmail.com>";
$headers[] = "X-Mailer: PHP/" . phpversion();

// Email body
$email_body = "
    <html>
    <head>
        <title>Test Email</title>
    </head>
    <body>
        <h2>Test Email Success!</h2>
        <p>This is a test email to verify that your contact form email configuration is working correctly.</p>
        <p><strong>Configuration Details:</strong></p>
        <ul>
            <li>Using: PHP mail() function</li>
            <li>From: NIMA Logistics Website</li>
            <li>To: {$to}</li>
        </ul>
        <p>If you received this email, your contact form will now send emails when visitors submit messages!</p>
        <hr>
        <p><small>Sent at: " . date('Y-m-d H:i:s') . "</small></p>
    </body>
    </html>
";

// Send test email
$email_sent = mail($to, $subject, $email_body, implode("\r\n", $headers));

if ($email_sent) {
    echo "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
    echo "✅ <strong>Test email sent successfully!</strong><br>";
    echo "Check your email at <strong>{$to}</strong> to confirm receipt.<br>";
    echo "Your contact form is now ready to send emails!";
    echo "</div>";
} else {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
    echo "❌ <strong>Error sending test email:</strong><br>";
    echo "PHP mail() function failed. This could be due to server configuration.";
    echo "</div>";
    echo "<div style='background: #fff3cd; color: #856404; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
    echo "💡 <strong>Note:</strong> PHP mail() function may not work on all servers. For production use, consider:";
    echo "<ul>";
    echo "<li>Configuring your server's mail settings</li>";
    echo "<li>Using a third-party email service (SendGrid, Mailgun, etc.)</li>";
    echo "<li>Setting up a proper SMTP configuration</li>";
    echo "</ul>";
    echo "</div>";
}

echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>Check your email at <strong>{$to}</strong> for the test message</li>";
echo "<li>If you received the test email, your contact form is ready!</li>";
echo "<li>Try submitting a message through your website's contact form</li>";
echo "<li>You should receive email notifications for all contact form submissions</li>";
echo "</ol>";

echo "<p><a href='../../pages/index.html' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>← Back to Website</a></p>";
?> 