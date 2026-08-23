<?php
require 'php/session.php'; // redirects to login.php if not logged in
require 'php/db.php';

$pageTitle = "Dashboard";
require 'includes/header.php';
?>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>

<?php require 'includes/module.php'; // Member 4: application module (list/CRUD) ?>

<?php require 'includes/footer.php'; ?>
