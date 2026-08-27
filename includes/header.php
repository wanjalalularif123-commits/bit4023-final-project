<header>
    <div class="header-inner">
      <h1><a href="index.html" class="brand">Course Registration System</a></h1>
      <nav>
        <a href="index.html">Home</a>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="dashboard.php">Dashboard</a>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="login.php">Login</a>
          <a href="register.php">Register</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>
 