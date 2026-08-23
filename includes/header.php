<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : '[Your App Name]'; ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>[Your App Name]</h1>
    <nav>
      <a href="index.html">Home</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
      <?php if (isset($_SESSION['username'])): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
      <?php endif; ?>
    </nav>
  </header>
  <main>
