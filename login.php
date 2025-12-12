<?php
session_start();
require_once 'config.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!$username || !$password) $errors[] = 'Both fields are required.';
    if (!$errors) {
        $stmt = $mysqli->prepare('SELECT id, username, email, password, is_admin FROM users WHERE username=? LIMIT 1');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                unset($row['password']);
                $_SESSION['user'] = $row;
                header('Location: index.php');
                exit;
            } else {
                $errors[] = 'Invalid credentials.';
            }
        } else {
            $errors[] = 'Invalid credentials.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container py-5">
      <div class="card mx-auto" style="max-width:480px;">
        <div class="card-body">
          <h3 class="card-title">Login</h3>
          <?php if($errors): ?>
            <div class="alert alert-danger"><?php foreach($errors as $e) echo '<div>'.esc($e).'</div>'; ?></div>
          <?php endif; ?>
          <form method="post" novalidate>
            <div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" required></div>
            <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required></div>
            <button class="btn btn-primary" type="submit">Login</button>
            <a class="btn btn-link" href="register.php">Register</a>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
