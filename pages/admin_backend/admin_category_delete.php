<?php
include "../../config.php";
session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $timestamp = date('Y-m-d H:i:s');

    // Optional: Get name of category before deletion for logging
    $result = $conn->query("SELECT name FROM category WHERE category_id = $id");
    $row = $result->fetch_assoc();
    $category_name = $row['name'] ?? 'Unknown';

    $query = "DELETE FROM category WHERE category_id = $id";

    if ($conn->query($query) === TRUE) {
        // Log to ACTIVITY_LOG
        $action = "Delete Category";
        $details = "Deleted category ID $id (name: $category_name)";
        $log_sql = "INSERT INTO ACTIVITY_LOG (action, timestamp, details, USER_user_id)
                    VALUES ('$action', '$timestamp', '$details', $user_id)";
        $conn->query($log_sql);

        echo "Category deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
