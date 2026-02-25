<?php

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo 'Invalid id';
    exit;
}
$id = (int)$_GET['id'];

require_once __DIR__ . '/db_conn.php';
try {
    $pdo = getPDO();
    // Try image_questions first (main table with options)
    $stmt = $pdo->prepare('SELECT image, filename FROM image_questions WHERE id = :id LIMIT 1');
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Fallback to questions table if not found
    if (!$row) {
        $stmt = $pdo->prepare('SELECT image, filename FROM questions WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    if (!$row) {
        http_response_code(404);
        echo 'Not found';
        exit;
    }

    $img = $row['image'];
    $filename = $row['filename'] ?? 'image';

    // guess mime type from filename
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $mime = 'application/octet-stream';
    if ($ext === 'png') $mime = 'image/png';
    else if ($ext === 'jpg' || $ext === 'jpeg') $mime = 'image/jpeg';
    else if ($ext === 'gif') $mime = 'image/gif';
    else if ($ext === 'webp') $mime = 'image/webp';

    header('Content-Type: ' . $mime);
    header('Content-Length: ' . strlen($img));
    header('Cache-Control: public, max-age=3600');
    echo $img;
} catch (Exception $e) {
    http_response_code(500);
    echo 'Server error: ' . $e->getMessage();
}
?>
