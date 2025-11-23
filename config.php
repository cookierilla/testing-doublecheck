<?php
$host = "localhost";
$username = "root";
$password = ""; 
$database = "db_doublecheck";

date_default_timezone_set('Asia/Manila');

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>