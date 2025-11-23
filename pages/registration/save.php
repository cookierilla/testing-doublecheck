<?php
include "../../config.php";

$id = $_POST['id'] ?? null;
$first_name = ucfirst($_POST['first_name']);
$last_name = ucfirst($_POST['last_name']);
$middle_name = ucfirst($_POST['middle_name']);
$age = $_POST['age'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password_hash_md5'];
$password_hash_md5 = md5($_POST['password_hash_md5']);
$confirm_password_md5 = md5($_POST['confirm_password_md5']);
$phone_number = $_POST['phone_number'];
$admin_role = $_POST['admin_role'] ?? "user";


if (empty($first_name) || empty($last_name) || empty($age) || empty($email) || empty($username) || empty($password_hash_md5) || empty($confirm_password_md5)) {
    echo "Please fill in all fields.";
    exit;
}

if ($password_hash_md5 !== $confirm_password_md5) {
    echo "Password Error: Password and Confirm Password do not match.";
    exit;
}

if (strlen($password) < 8) {
    echo "Password Error: Password must be at least 8 characters long.";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email Error: Invalid email format.";
    exit;
}

if (!empty($phone_number) && !preg_match('/^[0-9]{11}$/', $phone_number)) {
    echo "Phone Number Error: Invalid phone number format.";
    exit;
}

if (!$id) {
    $checkUsername = $conn->query("SELECT * FROM `user` WHERE username = '$username'");
    if ($checkUsername->num_rows > 0) {
        echo "User Exist Error: Username already exists.";
        exit;
    }
}

if ($id) {
    $query = "UPDATE `user` SET first_name='$first_name', last_name='$last_name', middle_name='$middle_name', age='$age', email='$email', username='$username', password_hash_md5='$password_hash_md5', confirm_password_md5='$confirm_password_md5', phone_number='$phone_number', admin_role='$admin_role' WHERE user_id=$id";
} else {
    $query = "INSERT INTO `user` (first_name, last_name, middle_name, age, email, username, password_hash_md5, confirm_password_md5, phone_number, admin_role) VALUES ('$first_name', '$last_name', '$middle_name', '$age', '$email', '$username', '$password_hash_md5', '$confirm_password_md5', '$phone_number', '$admin_role')";
}

if ($conn->query($query)) {
    if ($id) {
        $user_id = $id;
        $action = "Updated user account";
    } else {
        $user_id = $conn->insert_id;
        $action = "Registered new account";
    }

    $details = "Username: $username, Email: $email, Role: $admin_role";
    $timestamp = date('Y-m-d H:i:s');

    $log_query = "INSERT INTO ACTIVITY_LOG (action, timestamp, details, USER_user_id) 
                  VALUES ('$action', '$timestamp', '$details', $user_id)";
    $conn->query($log_query);

    echo "Account registered successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>
