<?php include "../../config.php"; ?>
<!-- navbar -->
<div class="menu shadow epilogue">
    <a class="menu-button first" href="../admin/admin_about_us.php">
        <img class="img-icon" src="../../assets/images/Logo-Two.png" alt="logo"> <span class="menu-text epilogue">Double-Check</span>
    </a>
    <a class="menu-button <?php echo basename($_SERVER['PHP_SELF']) === 'admin_dashboard.php' ? "active" : ""; ?>" href="../admin/admin_dashboard.php" data-page="dashboard"> 
        <i class="fas fa-home"></i> 
        <span class="menu-text">Dashboard</span> 
    </a>
    <a class="menu-button <?php echo basename($_SERVER['PHP_SELF']) === 'admin_articles_dashboard.php' ? "active" : ""; ?>" href="../admin/admin_articles_dashboard.php" data-page="articles"> 
        <i class="fas fa-bars"></i> 
        <span class="menu-text">Articles</span>
    </a>
    <a class="menu-button <?php echo basename($_SERVER['PHP_SELF']) === 'admin_accounts_dashboard.php' ? "active" : ""; ?>" href="../admin/admin_accounts_dashboard.php" data-page="accounts"> 
        <i class="fa-solid fa-users"></i>
        <span class="menu-text">Accounts</span> 
    </a>
    <a class="menu-button <?php echo basename($_SERVER['PHP_SELF']) === 'admin_profile_page.php' ? "active" : ""; ?>" href="../admin/admin_profile_page.php" data-page="profile"> 
        <i class="fas fa-user"></i> 
        <span class="menu-text">Profile</span> 
    </a>
    <a class="menu-button last" href="../login/logout.php">
        <i class="fas fa-sign-out-alt"></i>
        <span class="menu-text epilogue">Logout</span>
    </a>
</div>