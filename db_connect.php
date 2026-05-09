<?php
// db_connect.php
// Update the credentials if your XAMPP setup uses a different user or password.
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'uruseminary';

$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');
?>
