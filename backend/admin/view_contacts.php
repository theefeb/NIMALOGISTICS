<?php
// Simple admin page to view contact submissions
$host = "localhost";
$user = "root";
$pass = "";
$db = "nima_logistics";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all contact messages
$sql = "SELECT * FROM contact_messages ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages - NIMA LOGISTICS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #1e40af; text-align: center; margin-bottom: 30px; }
        .message { border: 1px solid #ddd; margin: 10px 0; padding: 15px; border-radius: 5px; background: #f9f9f9; }
        .message-header { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .name { font-weight: bold; color: #1e40af; }
        .email { color: #666; }
        .date { color: #999; font-size: 0.9em; }
        .message-content { background: white; padding: 10px; border-radius: 3px; border-left: 3px solid #1e40af; }
        .no-messages { text-align: center; color: #666; font-style: italic; padding: 40px; }
        .stats { background: #e3f2fd; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📧 Contact Messages - NIMA LOGISTICS</h1>
        
        <?php
        if ($result && $result->num_rows > 0) {
            echo '<div class="stats">';
            echo '<strong>Total Messages: ' . $result->num_rows . '</strong>';
            echo '</div>';
            
            while($row = $result->fetch_assoc()) {
                echo '<div class="message">';
                echo '<div class="message-header">';
                echo '<span class="name">' . htmlspecialchars($row['name']) . '</span>';
                echo '<span class="email">' . htmlspecialchars($row['email']) . '</span>';
                echo '<span class="date">' . $row['created_at'] . '</span>';
                echo '</div>';
                echo '<div class="message-content">' . nl2br(htmlspecialchars($row['message'])) . '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="no-messages">No contact messages found.</div>';
        }
        ?>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="index.html" style="background: #1e40af; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">← Back to Website</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?> 