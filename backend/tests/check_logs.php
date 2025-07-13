<?php
echo "<h2>PHP Error Log Check</h2>";

// Check if error log file exists
$log_file = ini_get('error_log');
if (empty($log_file)) {
    $log_file = 'C:\xampp\php\logs\php_error_log';
}

echo "<h3>Error Log File: $log_file</h3>";

if (file_exists($log_file)) {
    echo "<p style='color: green;'>✅ Error log file found</p>";
    
    // Get the last 20 lines of the log
    $lines = file($log_file);
    $recent_lines = array_slice($lines, -20);
    
    echo "<h3>Recent Error Log Entries:</h3>";
    echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 5px; font-family: monospace; font-size: 12px; max-height: 400px; overflow-y: auto;'>";
    foreach ($recent_lines as $line) {
        echo htmlspecialchars($line) . "<br>";
    }
    echo "</div>";
} else {
    echo "<p style='color: red;'>❌ Error log file not found at: $log_file</p>";
}

// Check XAMPP Apache error log
$apache_log = 'C:\xampp\apache\logs\error.log';
echo "<h3>Apache Error Log: $apache_log</h3>";

if (file_exists($apache_log)) {
    echo "<p style='color: green;'>✅ Apache error log found</p>";
    
    $lines = file($apache_log);
    $recent_lines = array_slice($lines, -10);
    
    echo "<h3>Recent Apache Error Log Entries:</h3>";
    echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 5px; font-family: monospace; font-size: 12px; max-height: 300px; overflow-y: auto;'>";
    foreach ($recent_lines as $line) {
        echo htmlspecialchars($line) . "<br>";
    }
    echo "</div>";
} else {
    echo "<p style='color: red;'>❌ Apache error log not found</p>";
}

// Test current PHP configuration
echo "<h3>PHP Configuration</h3>";
echo "<p><strong>PHP Version:</strong> " . PHP_VERSION . "</p>";
echo "<p><strong>Error Reporting:</strong> " . ini_get('error_reporting') . "</p>";
echo "<p><strong>Display Errors:</strong> " . ini_get('display_errors') . "</p>";
echo "<p><strong>Log Errors:</strong> " . ini_get('log_errors') . "</p>";

// Check if required files exist
echo "<h3>Required Files Check</h3>";
$required_files = [
    'vendor/autoload.php' => 'Composer Autoloader',
    'email_config.php' => 'Email Configuration',
    'submit_contact_smtp.php' => 'Contact Form Handler'
];

foreach ($required_files as $file => $description) {
    if (file_exists($file)) {
        echo "<p style='color: green;'>✅ $description ($file)</p>";
    } else {
        echo "<p style='color: red;'>❌ $description ($file) - MISSING</p>";
    }
}

echo "<h3>Quick Actions</h3>";
echo "<p><a href='test_contact_form.html' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🧪 Test Contact Form</a></p>";
echo "<p><a href='test_email_send.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>📧 Send Test Email</a></p>";
echo "<p><a href='index.html' style='background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>← Back to Website</a></p>";
?> 