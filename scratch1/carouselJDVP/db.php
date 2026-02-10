<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "myshop";

$conn = new mysqli ($host,$username,$password,$dbname);

if($conn->connect_error){
die ("Connection Failed!" . $conn->connect_error);
}


// Generate next student ID
$nextPID = 1;
$result = $conn->query("SELECT MAX(product_id) AS id FROM products");
if ($result && $row = $result->fetch_assoc()) {
    $nextPID = $row['id'] + 1;
}
    
?>