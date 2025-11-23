<?php
include "../../config.php";

$user_id = $_POST['user_id'] ?? null;
$first_name = ucfirst($_POST['first_name']) ?? '';
$last_name = ucfirst($_POST['last_name']) ?? '';
$middle_name = ucfirst($_POST['middle_name']) ?? '';
$age = $_POST['age'] ?? '';
$email = $_POST['email'] ?? '';
$username = $_POST['username'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$admin_role = $_POST['admin_role'] ?? "user";

//Check for Password change
$password_hash_md5 = '';
$confirm_password_md5 = '';
if (!empty($_POST['password_hash_md5']) && !empty($_POST['confirm_password_md5'])) {
    $password = $_POST['password_hash_md5'];
    $password_hash_md5 = md5($password);
    $confirm_password_md5 = md5($_POST['confirm_password_md5']);

    if ($password_hash_md5 !== $confirm_password_md5) {
        echo "Password Error: Password and Confirm Password do not match.";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Password Error: Password must be at least 8 characters long.";
        exit;
    }
}

// Validate input
if (empty($first_name) || empty($last_name) || empty($age) || empty($email) || empty($username)) {
    echo "Please fill in all fields.";
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

if ($user_id) {
    // EDIT USER ACCOUNT
    if (!empty($password_hash_md5) && !empty($confirm_password_md5)) {
        $query = "UPDATE user SET first_name='$first_name', last_name='$last_name', middle_name='$middle_name', age='$age', email='$email', username='$username', password_hash_md5='$password_hash_md5', confirm_password_md5='$confirm_password_md5', phone_number='$phone_number', admin_role='$admin_role' WHERE user_id=$user_id";
    } else {
        $query = "UPDATE user SET first_name='$first_name', last_name='$last_name', middle_name='$middle_name', age='$age', email='$email', username='$username', phone_number='$phone_number', admin_role='$admin_role' WHERE user_id=$user_id";
    }

    if ($conn->query($query)) {
        // Log the edit action
        session_start();
        $admin_id = $_SESSION['user_id'] ?? null;

        if ($admin_id) {
            $timestamp = date('Y-m-d H:i:s');
            $action = "Edit Account";
            $details = "Edited account with user_id = $user_id";

            $log_query = "INSERT INTO ACTIVITY_LOG (action, timestamp, details, USER_user_id) VALUES ('$action', '$timestamp', '$details', $admin_id)";
            $conn->query($log_query); // optional error handling can be added
        }

        echo "Account edited successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

} else {
    // CREATE NEW USER ACCOUNT
    $query = "INSERT INTO user (first_name, last_name, middle_name, age, email, username, password_hash_md5, confirm_password_md5, phone_number, admin_role) VALUES ('$first_name', '$last_name', '$middle_name', '$age', '$email', '$username', '$password_hash_md5', '$confirm_password_md5', '$phone_number', '$admin_role')";

    if ($conn->query($query)) {
        echo "Account created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
