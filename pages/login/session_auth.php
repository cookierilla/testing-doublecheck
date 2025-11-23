 <?php   include '../../config.php';

session_start();

// Check if user is not logged in
if (!isset($_SESSION['user_id'])) {
    echo '<script>
    alert("Please Login an Account");
    window.location.href="../login/login.php";
    </script>';
}
?>