<?php
include "../../config.php";

session_start();

// Log logout activity
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $action = 'User Logout';
    $timestamp = date('Y-m-d H:i:s');
    $details = 'User ' . $_SESSION['username'] . ' logged out.';

    $log_query = "INSERT INTO activity_log (action, timestamp, details, USER_user_id) 
                  VALUES ('$action', '$timestamp', '$details', $user_id)";
    $conn->query($log_query); // Optional: Add error handling if needed
}

// Clear session and destroy it
session_unset();
session_destroy();

header("Location: login.php"); // Redirect to login
exit;
?>