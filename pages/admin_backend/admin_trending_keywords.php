<?php
include "../../config.php";

// Query to get the top trending keywords from your database
$query = "
    SELECT k.word, COUNT(*) AS count
    FROM article_keyword ak
    JOIN keyword k ON ak.KEYWORD_keyword_id = k.keyword_id
    GROUP BY k.word
    ORDER BY count DESC
    LIMIT 10
";

$result = $conn->query($query);
$keywords = [];

while ($row = $result->fetch_assoc()) {
    $keywords[] = [
        'label' => $row['word'],
        'count' => (int) $row['count']
    ];
}

// Return data as JSON
echo json_encode($keywords);
?>
