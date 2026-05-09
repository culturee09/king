<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: admissions.html');
    exit;
}

function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$first_name = sanitize($_POST['first_name'] ?? '');
$last_name = sanitize($_POST['last_name'] ?? '');
$date_of_birth = sanitize($_POST['date_of_birth'] ?? '');
$gender = sanitize($_POST['gender'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$phone = sanitize($_POST['phone'] ?? '');
$address = sanitize($_POST['address'] ?? '');
$previous_school = sanitize($_POST['previous_school'] ?? '');
$subjects = sanitize($_POST['subjects'] ?? '');
$level_applying = sanitize($_POST['level_applying'] ?? '');
$declaration = sanitize($_POST['declaration'] ?? '');

if (empty($first_name) || empty($last_name) || empty($date_of_birth) || empty($gender) || empty($email) || empty($phone) || empty($address) || empty($previous_school) || empty($subjects) || empty($level_applying) || empty($declaration)) {
    echo '<p>Please complete all required fields. <a href="admissions.html">Return to the application.</a></p>';
    exit;
}

$stmt = $mysqli->prepare('INSERT INTO admissions (first_name, last_name, date_of_birth, gender, email, phone, address, previous_school, subjects, level_applying, declaration) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
if (!$stmt) {
    echo '<p>Database error: failed to prepare statement.</p>';
    exit;
}

$stmt->bind_param('sssssssssss', $first_name, $last_name, $date_of_birth, $gender, $email, $phone, $address, $previous_school, $subjects, $level_applying, $declaration);
if ($stmt->execute()) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Application Submitted</title>
      <link rel="stylesheet" href="style.css" />
    </head>
    <body>
      <main class="section" style="padding-top: 6rem; padding-bottom: 6rem;">
        <div class="container" style="max-width: 720px; text-align: center;">
          <h1>Application Submitted</h1>
          <p class="muted">Thank you, <?php echo htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8'); ?>. Your admission application has been received successfully.</p>
          <p>Our admissions office will review your information and contact you with the next steps.</p>
          <a href="index.html" class="btn btn-primary">Return Home</a>
        </div>
      </main>
    </body>
    </html>
    <?php
} else {
    echo '<p>There was an issue submitting your application. Please try again later.</p>';
}
$stmt->close();
$mysqli->close();
?>
