<h2>Login</h2>
<?php if (!empty($success)): ?>
  <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
<?php endif; ?>
<?php if (!empty($error)): ?>
  <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST" id="loginForm">
  <label>Username: <input type="text" name="username" required></label>
  <label>Password: <input type="password" name="password" id="password" required></label>
  <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register</a></p>
<script src="js/validation.js"></script>
<script src="js/ui.js"></script>
