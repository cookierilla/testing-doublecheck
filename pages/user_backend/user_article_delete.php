<?php
include "../../config.php";
session_start(); // needed to access $_SESSION['user_id']

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $user_id = $_SESSION['user_id'];

    $query = "DELETE FROM article WHERE article_id = $id";

    if ($conn->query($query) === TRUE) {
        // Log deletion
        $details = "Deleted article ID: $id, User ID: $user_id";
        $logQuery = "INSERT INTO activity_log (action, timestamp, details, USER_user_id)
             VALUES ('Deleted Article', NOW(), '$details', $user_id)";
        $conn->query($logQuery);

        echo "Article deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
