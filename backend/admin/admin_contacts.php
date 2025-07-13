<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: admin_login.php');
    exit;
}
?>
<a href="admin_logout.php" style="float:right;">Logout</a>
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "nima_logistics";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Contact Messages</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #1e3a8a; color: #fff; }
    </style>
</head>
<body>
    <h1>All Contact Messages</h1>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Created At</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
            <td><?= htmlspecialchars($row['created_at']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?> 