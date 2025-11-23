<?php
include "../../config.php";
session_start();

header('Content-Type: application/json');

$login = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($login) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username/Email and password are required.']);
    exit;
}

$password_md5 = md5($password);

$query = "SELECT * FROM user WHERE ((BINARY username = '$login') OR (email = '$login')) AND password_hash_md5 = '$password_md5'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin_role'] = $user['admin_role']; 

    // Log login activity
    $user_id = $user['user_id'];
    $action = 'User Login';
    $timestamp = date('Y-m-d H:i:s');
    $details = 'User ' . $user['username'] . ' logged in.';

    $log_query = "INSERT INTO activity_log (action, timestamp, details, USER_user_id) 
                  VALUES ('$action', '$timestamp', '$details', $user_id)";
    $conn->query($log_query); // Optional: Add error handling if needed

    // Redirect based on role
    if ($user['admin_role'] == "admin") {
        echo json_encode(['success' => true, 'redirect' => '../../pages/admin/admin_dashboard.php']);
    } else {
        echo json_encode(['success' => true, 'redirect' => '../../pages/user/user_dashboard.php']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid username/email or password.']);
}
?>
