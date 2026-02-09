<?php
include 'db.php';

if (!isset($_GET['id'])) die("NO ID Specified.");
$id = intval(value: $_GET['id']); //sanitize output

$sql = "SELECT product_image FROM products WHERE product_id = $id";
$result = $conn->query(query: $sql);

if ($result->num_rows == 0) die ("NO image found.");

$row = $result->fetch_assoc();

// Detect MIME type dynamically

$finfo = finfo_open();
$type = finfo_buffer(finfo: $finfo, string: $row['product_image'], flags: FILEINFO_MIME_TYPE);
finfo_close(finfo: $finfo);

header(header: "Content-Type: $type");
echo $row['product_image'];
?>