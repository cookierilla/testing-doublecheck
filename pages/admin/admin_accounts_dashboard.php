<?php include "../../config.php"; 
include "../login/session_auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Accounts | Double-Check</title>

    <!--JQuery and Chart.js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!--Boostrap 5, Icons, and CSS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/styles.css">
    <link rel="stylesheet" href="../../assets/navbar.css">


    <!--Google Fonts-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,600;1,600&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap');
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="menu">
        <?php include "../../pages/include_elements/admin_navbar.php"; ?>
    </div>

    <!-- Main Content -->
    <div id="main-content-wrapper">
        <!-- Header -->
        <?php include "../../pages/include_elements/header.php"; ?>

        <!-- Start of Content -->
        <div class="content-area container-fluid">
            <div class="col">
                <div class="container-fluid mt-5">
                    <h1 class="titles epilogue">Double-Check some Accounts</h1>
                </div>


                <div class="card text-center h-100 w-100 shadow poppins-regular">
                    <div class="card-body">

                        <div class="card-title">
                            <div class="row row-cols-1 row-cols-md-2 g-1">
                                <!--Search Button to open modal-->
                                <div class="col-md-9 col-12 d-flex">
                                    <button class="btn btn-outline-primary " data-bs-toggle="modal" data-bs-target="#searchModal">Search</button>
                                </div>

                                <!--Add New User Button-->
                                <div class="col-md-2 col-12 d-flex">
                                    <a class="btn btn-md w-100 buttonBrand" href="admin_add_account_page.php" type="button">+ Add New User</a>
                                </div>

                                <!--Export Button-->
                                <div class="col-md-1 col-12 d-flex">
                                <a class="btn btn-md w-100 buttonSecondary" id="exportAccountBtn">Export</a>
                                </div>
                            </div>
                        </div>

                        <!--Table-->
                        <div class="big-scrollable-table table-responsive-sm" style="overflow-x: auto;">
                            <table class="table table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Middle Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Role</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="userTable">
                                    <!-- Accounts list will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>
                        <?php include "../admin_backend/admin_edit_account_modal.php"; ?>
                        <?php include "../admin_backend/search_modal.php"; ?>


                        <div class="card-footer">
                            <img class="img-icon" src="../../assets/images/Logo-Two.png" alt="logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--scripts-->
    <script src="../../scripts/script.js"></script>
    <script src="../../scripts/accounts_script.js"></script>
    <script src="../../scripts/export.js"></script>
</body>

</html>