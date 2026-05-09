<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html');
    exit;
}

function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$name = sanitize($_POST['contact_name'] ?? '');
$email = filter_var($_POST['contact_email'] ?? '', FILTER_SANITIZE_EMAIL);
$message = sanitize($_POST['contact_message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    echo '<p>Please complete all required fields. <a href="contact.html">Return to the contact form.</a></p>';
    exit;
}

$stmt = $mysqli->prepare('INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)');
if (!$stmt) {
    echo '<p>Database error: failed to prepare statement.</p>';
    exit;
}

$stmt->bind_param('sss', $name, $email, $message);
if ($stmt->execute()) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Message Sent</title>
      <link rel="stylesheet" href="style.css" />
    </head>
    <body>
      <main class="section" style="padding-top: 6rem; padding-bottom: 6rem;">
        <div class="container" style="max-width: 720px; text-align: center;">
          <h1>Message Sent</h1>
          <p class="muted">Thank you, <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>. Your message has been received.</p>
          <p>Our office will respond as soon as possible.</p>
          <a href="index.html" class="btn btn-primary">Return Home</a>
        </div>
      </main>
    </body>
    </html>
    <?php
} else {
    echo '<p>Unable to send your message at this time. Please try again later.</p>';
}

$stmt->close();
$mysqli->close();
?>
