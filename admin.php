<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit;
}

require_once 'db_connect.php';

$admissions = $mysqli->query('SELECT id, first_name, last_name, date_of_birth, gender, email, phone, level_applying, created_at FROM admissions ORDER BY created_at DESC');
$contacts = $mysqli->query('SELECT id, name, email, message, created_at FROM contact_messages ORDER BY created_at DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Uru Minor Seminary | Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Libre+Baskerville:wght@400;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header class="site-header" id="siteHeader">
    <div class="container header-inner">
      <a href="index.html" class="brand">Uru Minor Seminary</a>
      <nav class="nav-menu" id="navMenu">
        <a href="index.html">Home</a>
        <a href="about.html">Our Heritage</a>
        <a href="admissions.html">Admissions</a>
        <a href="contact.html">Contact</a>
        <a href="logout.php">Logout</a>
      </nav>
    </div>
  </header>

  <main>
    <section class="section">
      <div class="container">
        <div class="section-header">
          <p class="section-label">Admin Dashboard</p>
          <h2>Submissions Overview</h2>
          <div class="divider"><span>✝</span></div>
        </div>

        <div class="admin-section">
          <h3>Admissions Submissions</h3>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>DOB</th>
                  <th>Gender</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Level</th>
                  <th>Submitted</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($admissions && $admissions->num_rows > 0): ?>
                  <?php while ($row = $admissions->fetch_assoc()): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['id']); ?></td>
                      <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                      <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
                      <td><?php echo htmlspecialchars($row['gender']); ?></td>
                      <td><?php echo htmlspecialchars($row['email']); ?></td>
                      <td><?php echo htmlspecialchars($row['phone']); ?></td>
                      <td><?php echo htmlspecialchars($row['level_applying']); ?></td>
                      <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr><td colspan="8">No admissions submissions yet.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="admin-section">
          <h3>Contact Messages</h3>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Received</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($contacts && $contacts->num_rows > 0): ?>
                  <?php while ($row = $contacts->fetch_assoc()): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['id']); ?></td>
                      <td><?php echo htmlspecialchars($row['name']); ?></td>
                      <td><?php echo htmlspecialchars($row['email']); ?></td>
                      <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                      <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr><td colspan="5">No contact messages yet.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container footer-grid">
      <div>
        <h3>Admin Access</h3>
        <p>Use this page to review form submissions securely on your local XAMPP setup.</p>
      </div>
      <div>
        <p><strong>Note</strong><br />Remove or protect this page before deploying publicly.</p>
      </div>
    </div>
    <p class="footer-note">© 2026 Uru Minor Seminary.</p>
  </footer>
</body>
</html>
