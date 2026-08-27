<?php
require "config.php";

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = trim($_POST["full_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm = $_POST["confirm_password"] ?? "";
    $role = $_POST["role"] ?? "";

    if ($fullName === "" || $email === "" || $password === "") {
        $errors[] = "All fields are required.";
    }
    if (!in_array($role, ["student", "lecturer"], true)) {
        $errors[] = "Please select whether you are a student or a lecturer.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }
    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = "An account with that email already exists.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare(
                "INSERT INTO users (full_name, email, password_hash, role) VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$fullName, $email, $hash, $role]);
            $success = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Course Registration System</title>
 <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require "includes/header.php"; ?>

<main>
  <div class="form-container">
    <h2>Create Account</h2>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-error">
        <?php foreach ($errors as $err): ?>
          <div><?= htmlspecialchars($err) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
      <div class="alert alert-success">
        Account created successfully. You can now <a href="login.php">log in</a>.
      </div>
    <?php endif; ?>

    <form method="POST" action="register.php" novalidate>
      <div class="form-group">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name"
               value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
      </div>
      <div class="form-group">
        <label>I am registering as:</label>
        <div class="role-options">
          <label class="role-option">
            <input type="radio" name="role" value="student"
              <?= (($_POST['role'] ?? '') === 'student' || !isset($_POST['role'])) ? 'checked' : '' ?>>
            Student
          </label>
          <label class="role-option">
            <input type="radio" name="role" value="lecturer"
              <?= (($_POST['role'] ?? '') === 'lecturer') ? 'checked' : '' ?>>
            Lecturer
          </label>
        </div>
      </div>
      <button type="submit" class="btn">Register</button>
    </form>

    <p class="form-footer">Already have an account? <a href="login.php">Log in</a></p>
  </div>
</main>

<?php require "includes/footer.php"; ?>

</body>
</html>
