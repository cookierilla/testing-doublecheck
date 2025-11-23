<?php
include "../../config.php";
session_start();
$user_id = $_SESSION['user_id'] ?? null;

// Set headers to prompt download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=users_export.csv');

$output = fopen('php://output', 'w');

// CSV headers
$headers = ['ID', 'Username', 'First Name', 'Last Name', 'Middle Name', 'Email', 'Age', 'Phone Number', 'Password', 'Role'];
fputcsv($output, $headers);

// Query users
$query = "SELECT user_id, username, first_name, last_name, middle_name, email, age, phone_number, password_hash_md5, admin_role FROM user ORDER BY user_id ASC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['user_id'],
        $row['username'],
        $row['first_name'],
        $row['last_name'],
        $row['middle_name'],
        $row['email'],
        $row['age'],
        $row['phone_number'],
        $row['password_hash_md5'],
        $row['admin_role']
    ]);
}

fclose($output);

// Insert export log
date_default_timezone_set('Asia/Manila');
$timestamp = date('Y-m-d H:i:s');
mysqli_query($conn, "INSERT INTO EXPORT_LOG (type, timestamp, USER_user_id) VALUES ('user', '$timestamp', $user_id)");

exit();
?>
