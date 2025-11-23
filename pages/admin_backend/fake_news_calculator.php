<?php
include "../../config.php"; 

$keyword_count = $_POST['keyword_count'];
$date_published = $_POST['date_published'];
$source = $_POST['source_url'] === 'true';
$content = $_POST['content'];

// Scoring configuration
$per_keyword_penalty = 3;      
$source_penalty = 50;         
$date_penalty = 20;            

$keyword_score = $keyword_count  * $per_keyword_penalty;

if (!$source) {
    $keyword_score += $source_penalty;
}
if ($date_published > 5) {
    $keyword_score += $date_penalty;
}

// final score at 100
$final_score = min(100, $keyword_score);

echo round($final_score, 2) . '%';
