<?php
include "../../config.php";
session_start();
$user_id = $_SESSION['user_id'];

$category_id = $_POST['category_id'] ?? null;
$name = $_POST['category_name'] ?? '';
$description = $_POST['category_description'] ?? '';
$alert_text = '';
$timestamp = date('Y-m-d H:i:s');

if ($category_id) {
    $query = "UPDATE category SET name='$name', description='$description' WHERE category_id=$category_id";
    $action = "Edit Category";
    $details = "Edited category ID $category_id to name: $name, description: $description";
    $alert_text = "Category edited successfully!";
} else {
    $query = "INSERT INTO category (name, description) VALUES ('$name', '$description')";
    $action = "Create Category";
    $details = "Created category with name: $name, description: $description";
    $alert_text = "Category created successfully!";
}

if ($conn->query($query)) {
    // Log to ACTIVITY_LOG
    $log_sql = "INSERT INTO ACTIVITY_LOG (action, timestamp, details, USER_user_id)
                VALUES ('$action', '$timestamp', '$details', $user_id)";
    $conn->query($log_sql);

    echo $alert_text;
} else {
    echo "Error: " . $conn->error;
}
?>
