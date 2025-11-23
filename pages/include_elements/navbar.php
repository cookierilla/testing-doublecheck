<?php include "../../config.php";
?>
<!-- navbar -->
<div class="menu shadow">
    <a class="menu-button first" href="../user/user_about_us.php">
        <img class="img-icon" src="../../assets/images/Logo-Two.png" alt="logo"> <span class="menu-text epilogue">Double-Check</span>
    </a>
    <a class='menu-button epilogue <?php echo basename($_SERVER['PHP_SELF']) === 'user_dashboard.php' ? "active" : ""; ?>' href="../user/user_dashboard.php" data-page="dashboard">
        <i class="fas fa-home"></i>
        <span class="menu-text">Dashboard</span>
    </a>

    <a class='menu-button epilogue <?php echo basename($_SERVER['PHP_SELF']) === 'user_profile.php' ? "active" : ""; ?>' href="../user/user_profile.php" data-page="profile">
        <i class="fas fa-user"></i>
        <span class="menu-text">Profile</span>
    </a>
    <a class="menu-button last" href="../login/logout.php">
        <i class="fas fa-sign-out-alt"></i>
        <span class="menu-text epilogue">Logout</span>
    </a>
</div>