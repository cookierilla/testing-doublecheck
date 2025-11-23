<?php include "../../config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account | Double-Check</title>

    <!--Boostrap 5 and CSS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles.css">
    <link rel="stylesheet" href="../../assets/register.css">
    <link rel="stylesheet" href="../../assets/login.css">

    <!--Google Fonts-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,600;1,600&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap');
    </style>

    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!--Background-->
    <div class="wave wave-right"></div>
    <div class="wave wave-left"></div>

    <div class="container-fluid mt-5 poppins-regular">
        <div class="row g-3 p-3 align-items-stretch" style="min-height: 100%;">

            <!-- Form Section -->
            <div class="col-md-7 d-flex">
                <div class="card p-3 form-container w-100 shadow">
                    <!-- Header -->
                    <header class="app-header py-3 mb-4">
                        <span class="app-title epilogue">Let’s Get Started</span>
                    </header>

                    <!-- Form -->
                    <form id="registrationForm" action="save.php" method="POST">
                        <!-- Form Container One -->
                        <div class="form-container p-4 mb-4">
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
                                </div>
                                <div class="col-md-4">
                                    <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-4">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter Middle Name">
                                </div>
                            </div>
                            <div class="row g-3 mb-2">
                                <div class="col-md-8">
                                    <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone number">
                                </div>
                                <div class="col-md-4">
                                    <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="age" name="age">
                                </div>
                            </div>
                        </div>

                        <!-- Form Container Two -->
                        <div class="form-container p-4">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="password_hash_md5" class="form-label">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password_hash_md5" name="password_hash_md5" placeholder="Enter Password">
                                        <button class="btn btn-outline-secondary password-toggle" type="button" data-target="password_hash_md5">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="confirm_password_md5" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirm_password_md5" name="confirm_password_md5" placeholder="Confirm Password">
                                        <button class="btn btn-outline-secondary password-toggle" type="button" data-target="confirm_password_md5">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="admin_role" id="admin_role" value="user" />
                            </div>
                        </div>

                </div>
            </div>

            <!-- Account Guidelines -->
            <div class="col-md-5 d-flex poppins-regular">
                <div class="card w-100 p-4 justify-content-center align-items-center poppins-regular guidelines-section">
                    <h2 class="mb-4 epilogue">Account Guidelines</h2>
                    <ul class="list-unstyled guidelines-list">
                        <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-compass me-2"></i> Mandatory Fields Set</li>
                        <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-compass me-2"></i> Make your Username Unique!</li>
                        <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-compass me-2"></i>11 digit Phone Number</li>
                        <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-compass me-2"></i></i> Password atleast 8 characters</li>
                        <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-compass me-2"></i></i>Confirm Passwords Match</li>
                    </ul>
                    <div class="text-center">
                        <input type="submit" class="btn btn-add-account mb-2" value="Add Account"></input>
                    </div>
                    <div class="text-center">
                        <a href="../login/login.php" class="btn btn-sm buttonSecondary fw-semibold text-decoration-none">Return to Login</a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
<!-- bi bi-check-circle-fill -->
    <!-- Script -->
    <script src="../../scripts/script.js"></script>
    <script src="../../scripts/accounts_script.js"></script>
</body>

</html>