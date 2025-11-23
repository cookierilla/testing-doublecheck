<?php
include "../../config.php";
session_start();
$user_id = $_SESSION['user_id'] ?? null;

// Set headers to prompt download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=articles_export.csv');

$output = fopen('php://output', 'w');

$headers = ['ID', 'Submitted By', 'Title', 'Content', 'Source URL', 'Date Published', 'Category', 'Submission Date', 'Status', 'Detection Results'];
fputcsv($output, $headers);

// Query articles
$query = "
    SELECT 
        a.article_id,
        u.username AS submitted_by,
        a.title,
        a.content,
        a.source_url,
        a.date_published,
        c.name AS category,
        a.submission_date,
        a.status,
        a.detection_result
    FROM article a
    LEFT JOIN user u ON a.User_user_id = u.user_id
    LEFT JOIN category c ON a.Category_category_id = c.category_id
    ORDER BY a.submission_date DESC
";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['article_id'],
        $row['submitted_by'],
        $row['title'],
        $row['content'],
        $row['source_url'],
        $row['date_published'],
        $row['category'],
        $row['submission_date'],
        $row['status'],
        $row['detection_result']
    ]);
}

fclose($output);

// Insert export log
date_default_timezone_set('Asia/Manila');
$timestamp = date('Y-m-d H:i:s');
mysqli_query($conn, "INSERT INTO EXPORT_LOG (type, timestamp, USER_user_id) VALUES ('articles', '$timestamp', $user_id)");

exit();
?>
