<?php
require "config.php";
require "php/db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Course Registration System</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require "includes/header.php"; ?>

<main>
  <h2>Welcome, <?= htmlspecialchars($_SESSION["full_name"]) ?></h2>
  <?php require "includes/module.php"; ?>
</main>

<?php require "includes/footer.php"; ?>

</body>
</html>
