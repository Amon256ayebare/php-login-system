<?php
session_start();
require_once 'config.php';
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
  <div class="container py-5">
    <div class="card mx-auto" style="max-width:800px;">
      <div class="card-body">
        <h3>Dashboard</h3>
        <p>Welcome, <strong><?php echo esc($user['username']); ?></strong></p>
        <?php if($user['is_admin']): ?>
          <div class="alert alert-info">You are an admin.</div>
        <?php endif; ?>
        <a class="btn btn-outline-secondary" href="index.php">Home</a>
        <a class="btn btn-danger" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</body></html>
