<?php
require 'php/session.php'; // redirects to login.php if not logged in
require 'php/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <a href="logout.php">Logout</a>
  </header>

  <main>
    <h2>Your Dashboard</h2>
    <!-- Member 4: application module (list/CRUD) goes here -->
  </main>
</body>
</html>
