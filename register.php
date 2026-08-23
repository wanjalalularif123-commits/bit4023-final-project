<?php
require 'php/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($username && $email && $password) {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already taken.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare("INSERT INTO users (username, password_hash, email) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $username, $hash, $email);
            $insert->execute();
            header("Location: login.php?registered=1");
            exit;
        }
    } else {
        $error = "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>Register</h2>
  <?php if ($error): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
  <?php endif; ?>

  <form method="POST" id="registerForm">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Password: <input type="password" name="password" id="password" required></label><br>
    <label>Confirm Password: <input type="password" name="confirm_password" id="confirm_password" required></label><br>
    <button type="submit">Register</button>
  </form>

  <p>Already have an account? <a href="login.php">Login</a></p>
  <script src="js/validation.js"></script>
</body>
</html>
