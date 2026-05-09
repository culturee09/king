<?php
session_start();

$loginError = '';
$adminUser = 'admin';
$adminPass = 'King2026!';

if (isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === $adminUser && $password === $adminPass) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    }

    $loginError = 'Invalid username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Uru Minor Seminary | Admin Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Libre+Baskerville:wght@400;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <main class="section" style="padding-top: 5rem; padding-bottom: 5rem;">
    <div class="container" style="max-width: 520px;">
      <div class="auth-card">
        <p class="section-label">Admin Access</p>
        <h2>Sign in to the Dashboard</h2>
        <?php if ($loginError): ?>
          <p class="error-message"><?php echo htmlspecialchars($loginError); ?></p>
        <?php endif; ?>
        <form method="post" action="admin_login.php">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required placeholder="Admin username" />
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required placeholder="Password" />
          <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
        <p class="note">Default user: <strong>admin</strong>. Change credentials in <code>admin_login.php</code> before deployment.</p>
      </div>
    </div>
  </main>
</body>
</html>
