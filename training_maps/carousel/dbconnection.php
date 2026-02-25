<?php
// DB connection using mysqli (localhost). Adjust username/password as needed for XAMPP.
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'training_maps';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    exit('Database connection failed: ' . $mysqli->connect_error);
}

$mysqli->set_charset('utf8mb4');

?>
