<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My PHP App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container py-5">
      <div class="card mx-auto" style="max-width:720px;">
        <div class="card-body">
          <h1 class="card-title">Welcome to My PHP App</h1>
          <?php if(!empty($_SESSION['user'])): ?>
            <p class="lead">Hello, <strong><?php echo htmlspecialchars($_SESSION['user']['username']); ?></strong></p>
            <a class="btn btn-primary" href="dashboard.php">Dashboard</a>
            <a class="btn btn-outline-secondary" href="logout.php">Logout</a>
          <?php else: ?>
            <p class="lead">This is a simple PHP + MySQL starter app ready for Render (Docker).</p>
            <a class="btn btn-primary" href="register.php">Register</a>
            <a class="btn btn-outline-primary" href="login.php">Login</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </body>
</html>
