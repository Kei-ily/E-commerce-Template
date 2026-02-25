<?php
// db_conn.php - PDO connection for quiz database

$host = "127.0.0.1";
$db = "quizdb";
$user = "root";
$pass = "";
$charset = "utf8mb4";

function getPDO() {
    global $host, $db, $user, $pass, $charset;
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    return new PDO($dsn, $user, $pass, $options);
}
?>
