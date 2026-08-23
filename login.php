<?php
session_start();
require 'php/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $hash);

    if ($stmt->fetch() && password_verify($password, $hash)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>Login</h2>
  <?php if (isset($_GET['registered'])): ?>
    <p style="color:green;">Registration successful. Please log in.</p>
  <?php endif; ?>
  <?php if ($error): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
  <?php endif; ?>

  <form method="POST" id="loginForm">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" id="password" required></label><br>
    <button type="submit">Login</button>
  </form>

  <p>Don't have an account? <a href="register.php">Register</a></p>
  <script src="js/validation.js"></script>
</body>
</html>
