<?php include "../../config.php"; 
include "../login/session_auth.php";

// Get article ID from URL
$user_id = $_SESSION['user_id'];

// Fetch article data
$output = null;
if ($user_id) {
    $query = "SELECT * FROM user WHERE user_id = $user_id";
    $result = $conn->query($query);
    $output = $result->fetch_assoc();
}

if (!$user_id) {
    header("Location: ../login/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($output['username']); ?>'s Profile | Double-Check</title>

    <!--Boostrap 5 and CSS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles.css">
    <link rel="stylesheet" href="../../assets/register.css">
    <link rel="stylesheet" href="../../assets/navbar.css">

    <!--Google Fonts-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,600;1,600&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap');
    </style>

    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!-- Sidebar -->
    <div class="menu">
        <?php include "../../pages/include_elements/navbar.php"; ?>
    </div>

    <!-- Main Content -->
    <div id="main-content-wrapper">
        <!-- Header -->
        <?php include "../../pages/include_elements/header.php"; ?>
        <div class="container-fluid">
            <div class="card m-5 shadow">
                <div class="card-header p-3 d-flex align-items-end">
                    <div>
                        <img class="img-brand" src="../../assets/images/Profile.png" alt="profile">
                    </div>
                    <h2><?php echo htmlspecialchars($output['username']); ?></h2>
                </div>

                <!-- Form Container One -->
                <div class="form-container p-4 mb-4">
                    <div class="row g-3 mb-3">
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($output['user_id']); ?>">
                        <div class="col-md-4">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($output['first_name']); ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($output['last_name']); ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo htmlspecialchars($output['middle_name']); ?>" readonly>
                        </div>
                    </div>
                    <div class="row g-3 mb-2">
                        <div class="col-md-8">
                            <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($output['phone_number']); ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($output['age']); ?>" readonly>
                        </div>
                    </div>
                </div>

                <!-- Form Container Two -->
                <div class="form-container p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($output['username']); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($output['email']); ?>" readonly>
                        </div>
                    </div>

                    <div class="text-end ">
                        <button class="btn buttonBrandv2 changeInfoBtn" data-bs-toggle="modal" data-bs-target="#ProfileModal">Change Information</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../user/user_change_info_modal.php"; ?>

    <script>
        const userId = <?php echo json_encode($_SESSION['user_id']); ?>;
        console.log("Logged in user ID:", userId);
    </script>
    <!--Scripts-->
    <script src="../../scripts/script.js"></script>
    <script src="../../scripts/user_profile_script.js"></script>
</body>

</html>