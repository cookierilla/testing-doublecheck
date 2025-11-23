<?php
include "../../config.php";
session_start();

$article_id = $_POST['article_id'] ?? null;
$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$date_published = $_POST['date_published'] ?? '';
$CATEGORY_category_id = $_POST['CATEGORY_category_id'] ?? '';
$USER_user_id = $_SESSION['user_id'] ?? '';
$source_url = $_POST['source_url'] ?? '';
$comment = $_POST['comment'] ?? '';

$title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
$content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

$submission_date = date('Y-m-d H:i:s');
$status = 'pending';
$detection_result = '';

// Validate required fields
$errors = [];

if (empty($title)) {
    $errors[] = "Title is required";
}
if (empty($content)) {
    $errors[] = "Content is required";
}
if (empty($source_url)) {
    $errors[] = "Source URL is required";
}
if (empty($date_published)) {
    $errors[] = "Date published is required";
}
if (empty($CATEGORY_category_id) || $CATEGORY_category_id <= 0) {
    $errors[] = "Please select a valid category";
}

if (!empty($errors)) {
    http_response_code(400);
    echo "Error: " . implode(", ", $errors);
    exit();
}

try {
    $action = "";
    $article_query_success = false;

    if ($article_id) {
        // Editing existing article
        $query = "UPDATE `article` SET 
                 title='$title', 
                 content='$content', 
                 date_published='$date_published', 
                 submission_date='$submission_date', 
                 source_url='$source_url', 
                 USER_user_id='$USER_user_id', 
                 CATEGORY_category_id='$CATEGORY_category_id' 
                 WHERE article_id='$article_id'";
        $action = "Edited Article";
    } else {
        // Creating new article
        $query = "INSERT INTO `article` 
                 (title, content, source_url, date_published, submission_date, status, detection_result, CATEGORY_category_id, USER_user_id) 
                 VALUES 
                 ('$title', '$content', '$source_url', '$date_published', '$submission_date', '$status', '$detection_result', '$CATEGORY_category_id', '$USER_user_id')";
        $action = "Added Article";
    }

    if ($conn->query($query)) {
        if (!$article_id) {
            $article_id = $conn->insert_id;
        }

        $article_query_success = true;

        // Optional comment
        if (!empty($comment)) {
            $comment_query = "INSERT INTO `comment` 
                            (content, created_at, ARTICLE_article_id, USER_user_id) 
                            VALUES 
                            ('$comment', NOW(), '$article_id', '$USER_user_id')";
            if (!$conn->query($comment_query)) {
                throw new Exception("Article saved, but failed to insert comment: " . $conn->error);
            }
        }

        // Log the activity
        $log_action = $action;
        $log_timestamp = date('Y-m-d H:i:s'); // in Manila timezone
        $log_details = "Article ID: $article_id | Title: $title";

        $log_query = "INSERT INTO ACTIVITY_LOG (action, timestamp, details, USER_user_id) 
                      VALUES ('$log_action', '$log_timestamp', '$log_details', '$USER_user_id')";

        if (!$conn->query($log_query)) {
            throw new Exception("Failed to log activity: " . $conn->error);
        }

        echo "Article saved successfully!";

    } else {
        throw new Exception("Database error: " . $conn->error);
    }
} catch (Exception $e) {
    http_response_code(500); 
    echo "Error: " . $e->getMessage();
}
