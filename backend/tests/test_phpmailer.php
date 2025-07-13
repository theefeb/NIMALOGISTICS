<?php
// Test script to verify PHPMailer installation and configuration
echo "<h2>PHPMailer Test</h2>";

// Test 1: Check if Composer autoloader exists
echo "<h3>1. Checking Composer Autoloader</h3>";
if (file_exists('vendor/autoload.php')) {
    echo "✅ Composer autoloader found<br>";
    require 'vendor/autoload.php';
} else {
    echo "❌ Composer autoloader not found<br>";
    exit;
}

// Test 2: Check if PHPMailer classes are available
echo "<h3>2. Checking PHPMailer Classes</h3>";
try {
    // These use statements need to be at the top level, but we'll test them differently
    $phpmailer_exists = class_exists('PHPMailer\PHPMailer\PHPMailer');
    $smtp_exists = class_exists('PHPMailer\PHPMailer\SMTP');
    $exception_exists = class_exists('PHPMailer\PHPMailer\Exception');
    
    if ($phpmailer_exists && $smtp_exists && $exception_exists) {
        echo "✅ PHPMailer classes loaded successfully<br>";
    } else {
        echo "❌ Some PHPMailer classes are missing<br>";
        exit;
    }
} catch (Exception $e) {
    echo "❌ Error loading PHPMailer classes: " . $e->getMessage() . "<br>";
    exit;
}

// Test 3: Check email configuration
echo "<h3>3. Checking Email Configuration</h3>";
if (file_exists('email_config.php')) {
    echo "✅ Email configuration file found<br>";
    require_once 'email_config.php';
    
    // Check if constants are defined
    $required_constants = ['SMTP_HOST', 'SMTP_PORT', 'SMTP_USERNAME', 'SMTP_PASSWORD'];
    $all_defined = true;
    
    foreach ($required_constants as $constant) {
        if (defined($constant)) {
            echo "✅ {$constant} is defined<br>";
        } else {
            echo "❌ {$constant} is not defined<br>";
            $all_defined = false;
        }
    }
    
    if (!$all_defined) {
        echo "<p><strong>⚠️ Please update email_config.php with your actual email credentials</strong></p>";
    }
} else {
    echo "❌ Email configuration file not found<br>";
}

// Test 4: Test PHPMailer object creation
echo "<h3>4. Testing PHPMailer Object Creation</h3>";
try {
    $mail = new PHPMailer(true);
    echo "✅ PHPMailer object created successfully<br>";
    
    // Test basic configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    echo "✅ Basic SMTP configuration applied<br>";
    
} catch (Exception $e) {
    echo "❌ Error creating PHPMailer object: " . $e->getMessage() . "<br>";
}

echo "<h3>5. Next Steps</h3>";
echo "<p>To complete the setup:</p>";
echo "<ol>";
echo "<li>Update <code>email_config.php</code> with your actual Gmail credentials</li>";
echo "<li>Enable 2-factor authentication on your Gmail account</li>";
echo "<li>Generate an App Password in your Google Account settings</li>";
echo "<li>Use the App Password in the SMTP_PASSWORD setting</li>";
echo "<li>Test the contact form on your website</li>";
echo "</ol>";

echo "<h3>6. Gmail App Password Setup</h3>";
echo "<p>To get an App Password for Gmail:</p>";
echo "<ol>";
echo "<li>Go to your Google Account settings</li>";
echo "<li>Navigate to Security → 2-Step Verification</li>";
echo "<li>Scroll down to 'App passwords'</li>";
echo "<li>Generate a new app password for 'Mail'</li>";
echo "<li>Use this password in your email_config.php file</li>";
echo "</ol>";
?> 