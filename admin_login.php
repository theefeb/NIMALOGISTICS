<?php
session_start();
$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    // Change these credentials!
    if ($user === 'admin' && $pass === 'yourpassword') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_bookings.php');
        exit;
    } else {
        $login_error = 'Invalid credentials.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <?php if ($login_error): ?><p style="color:red;"><?= htmlspecialchars($login_error) ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html> 