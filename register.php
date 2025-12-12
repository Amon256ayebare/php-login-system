<?php
session_start();
require_once 'config.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!$username) $errors[] = 'Username is required.';
    if (!$email) $errors[] = 'Email is required.';
    if (!$password) $errors[] = 'Password is required.';
    if (!$errors) {
        // check unique username/email
        $stmt = $mysqli->prepare('SELECT id FROM users WHERE username=? OR email=? LIMIT 1');
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = 'Username or email already exists.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $mysqli->prepare('INSERT INTO users (username, email, password, is_admin) VALUES (?, ?, ?, 0)');
            $ins->bind_param('sss', $username, $email, $hash);
            if ($ins->execute()) {
                $_SESSION['user'] = ['id' => $ins->insert_id, 'username' => $username, 'email' => $email, 'is_admin' => 0];
                header('Location: index.php');
                exit;
            } else {
                $errors[] = 'Registration failed. Try again.';
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container py-5">
      <div class="card mx-auto" style="max-width:600px;">
        <div class="card-body">
          <h3 class="card-title">Register</h3>
          <?php if($errors): ?>
            <div class="alert alert-danger">
              <ul><?php foreach($errors as $e) echo '<li>'.esc($e).'</li>'; ?></ul>
            </div>
          <?php endif; ?>
          <form method="post" novalidate>
            <div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" required></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" required></div>
            <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required></div>
            <button class="btn btn-primary" type="submit">Create account</button>
            <a class="btn btn-link" href="login.php">Already registered? Login</a>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
