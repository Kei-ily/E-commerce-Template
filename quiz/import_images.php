<?php
// import_images.php

$dir = __DIR__ . '';

require_once __DIR__ . '/db_conn.php';
try {
    $pdo = getPDO();
} catch (Exception $e) {
    echo "DB connection failed: " . $e->getMessage();
    exit(1);
}

$files = glob($dir . '/*.{png,jpg,jpeg}', GLOB_BRACE);
if (!$files) {
    echo "No PNG/JPG files found in $dir\n";
    exit(1);
}

$insert = $pdo->prepare('
    INSERT INTO image_questions (letter, filename, image, option_a, option_b, option_c, option_d, correct_option) 
    VALUES (:letter, :filename, :image, :option_a, :option_b, :option_c, :option_d, :correct_option)
');
$check = $pdo->prepare('SELECT id FROM image_questions WHERE filename = :filename LIMIT 1');

$count = 0;
foreach ($files as $file) {
    $filename = basename($file);
    $letter = strtoupper(pathinfo($filename, PATHINFO_FILENAME));

    // skip if already imported
    $check->execute([':filename' => $filename]);
    if ($check->fetch()) {
        echo "Skipping $filename (already imported)\n";
        continue;
    }

    $data = file_get_contents($file);
    $insert->execute([
        ':letter' => $letter,
        ':filename' => $filename,
        ':image' => $data,
        ':option_a' => null,
        ':option_b' => null,
        ':option_c' => null,
        ':option_d' => null,
        ':correct_option' => null,
    ]);
    $count++;
    echo "Imported: $filename\n";
}

echo "\nTotal imported: $count images into quizdb.image_questions\n";

// If run from browser, print a simple message
if (php_sapi_name() !== 'cli') {
    echo nl2br("Imported $count images into quizdb.image_questions");
}
?>
