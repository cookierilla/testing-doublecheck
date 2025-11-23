<?php
include "../../config.php";
session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $timestamp = date('Y-m-d H:i:s');

    // Optional: Get name of category before deletion for logging
    $result = $conn->query("SELECT CONCAT(first_name, ' ', last_name) AS full_name FROM USER WHERE user_id = $id");
    $row = $result->fetch_assoc();
    $account_name = $row['full_name'] ?? 'Unknown';


    $query = "DELETE FROM user WHERE user_id = $id";

    if ($conn->query($query) === TRUE) {
        // Log to ACTIVITY_LOG
        $action = "Delete account";
        $details = "Deleted account ID $id (name: $account_name)";
        $log_sql = "INSERT INTO ACTIVITY_LOG (action, timestamp, details, USER_user_id)
                    VALUES ('$action', '$timestamp', '$details', $user_id)";
        $conn->query($log_sql);

        echo "Account deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
