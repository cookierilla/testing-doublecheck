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
$password = $_POST['password_hash_md5'] ?? '';
$password_hash_md5 = md5($_POST['password_hash_md5']);

// Validate input
if (empty($first_name) || empty($last_name) || empty($age) || empty($email) || empty($username) || empty($password)) {
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

if (!$user_id) {
    $checkUsername = $conn->query("SELECT * FROM user WHERE username = '$username'");
    if ($checkUsername->num_rows > 0) {
        echo "User Exist Error: Username already exists.";
        exit;
    }
}

$sql = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    if (md5($password) === $row['password_hash_md5']) {
        $query = "UPDATE user SET 
                    first_name='$first_name', 
                    last_name='$last_name', 
                    middle_name='$middle_name', 
                    age='$age', 
                    email='$email', 
                    username='$username', 
                    phone_number='$phone_number' 
                  WHERE user_id=$user_id";

        if ($conn->query($query)) {
            echo "Account edited successfully!";

            // Log the activity
            $action = "Edit User Information";
            $timestamp = date('Y-m-d H:i:s');
            $details = "User $username (ID: $user_id) edited their profile information.";
            $logQuery = "INSERT INTO ACTIVITY_LOG (action, timestamp, details, USER_user_id) 
                         VALUES ('$action', '$timestamp', '$details', '$user_id')";
            $conn->query($logQuery);

        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Password mismatch. Cannot update user.";
    }
} else {
    echo "User not found.";
}
