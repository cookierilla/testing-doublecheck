<?php include "../../config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Double-Check</title>

  <!--Boostrap 5 and CSS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../../assets/styles.css">
  <link rel="stylesheet" href="../../assets/login.css">

  <!--JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--Google Fonts-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,600;1,600&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap');
    </style>
</head>

<body class="d-flex justify-content-center align-items-center min-vh-100">

  <!--Background-->
  <div class="wave wave-left"></div>
  <div class="wave wave-right"></div>

  <!--Login Card-->
  <div class="card shadow login-container">
    <!--Login Logo-->
    <div class="container-fluid text-center">
      <img src="../../assets/images/Logo-Two.png" alt="Logo" class="mb-3">
    </div>

    <h2 class="fw-bold mb-4 epilogue">Welcome back!</h2>
    <!--Login Form-->
    <form id="login_form" >
      <div class="mb-3 text-start">
        <label for="username" class="form-label inter">Username/Email</label>
        <input type="username" class="form-control rounded poppins-regular" id="username" name="username" placeholder="Enter your Username" required>
      </div>
      <div class="mb-3 text-start">
        <label for="password" class="form-label inter">Password</label>
        <input type="password" class="form-control rounded poppins-regular" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100 rounded py-2 fw-semibold poppins-regular">Login</button>
    </form>
    <div class="mt-3 text-center poppins-medium">
      Don't have an account? <a href="../registration/register.php" class="link-primary fw-semibold text-decoration-none">Sign Up</a>
    </div>
  </div>

  <!--Scripts-->
  <script src="../../scripts/script.js"></script>
  <script src="../../scripts/accounts_script.js"></script>
  <script src="../../scripts/session_handling.js"></script>
</body>

</html>