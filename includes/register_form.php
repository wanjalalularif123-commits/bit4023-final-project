<h2>Register</h2>
<?php if (!empty($error)): ?>
  <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST" id="registerForm">
  <label>Username: <input type="text" name="username" required></label>
  <label>Email: <input type="email" name="email" required></label>
  <label>Password: <input type="password" name="password" id="password" required></label>
  <label>Confirm Password: <input type="password" name="confirm_password" id="confirm_password" required></label>
  <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>
<script src="js/validation.js"></script>
<script src="js/ui.js"></script>
