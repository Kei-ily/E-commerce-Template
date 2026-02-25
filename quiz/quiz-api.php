<?php


header('Content-Type: application/json');

try {
    require_once __DIR__ . '/db_conn.php';
    $pdo = getPDO();
    
    // Fetch all questions from image_questions table
    $stmt = $pdo->query('
        SELECT 
            id, 
            question,
            option_a, 
            option_b, 
            option_c, 
            option_d, 
            correct_option
        FROM image_questions 
        WHERE image IS NOT NULL
        AND option_a IS NOT NULL
        ORDER BY id
    ');
    
    $questions = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $options = [];
        
        if ($row['option_a']) {
            $options[] = [
                'key' => 'A',
                'text' => $row['option_a'],
                'correct' => strtoupper($row['correct_option']) === 'A'
            ];
        }
        if ($row['option_b']) {
            $options[] = [
                'key' => 'B',
                'text' => $row['option_b'],
                'correct' => strtoupper($row['correct_option']) === 'B'
            ];
        }
        if ($row['option_c']) {
            $options[] = [
                'key' => 'C',
                'text' => $row['option_c'],
                'correct' => strtoupper($row['correct_option']) === 'C'
            ];
        }
        if ($row['option_d']) {
            $options[] = [
                'key' => 'D',
                'text' => $row['option_d'],
                'correct' => strtoupper($row['correct_option']) === 'D'
            ];
        }
        
        // Only include questions with all 4 options and a correct answer
        if (count($options) === 4 && $row['correct_option']) {
            $questions[] = [
                'id' => (int)$row['id'],
                'imageId' => (int)$row['id'],
                'question' => $row['question'] ?? 'What is the correct answer?',
                'options' => $options,
                'correct' => strtoupper($row['correct_option'])
            ];
        }
    }
    
    echo json_encode($questions, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
