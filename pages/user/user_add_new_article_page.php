<?php include "../../config.php"; 
include "../login/session_auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Article | Double-Check</title>

    <!--Boostrap 5, Icons, and CSS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/styles.css">
    <link rel="stylesheet" href="../../assets/navbar.css">
    <link rel="stylesheet" href="../../assets/register.css">

    <!--JQuery and Chart.js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!--Google Fonts-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,600;1,600&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap');
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="menu">
        <?php include "../../pages/include_elements/navbar.php"; ?>
    </div>

    <!-- Main Content -->
    <div id="main-content-wrapper">
        <!-- Start of Content -->
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="w-100 poppins-regular" style="max-width: 1200px;">
                <h1 class="titles epilogue">Double-Check a new Article</h1>
                <div class="card text-center shadow">
                    <div class="card-body">
                        <form id="articleForm" method="POST">
                            <!--Form Container One-->
                            <input type="hidden" id="USER_user_id" name="USER_user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <input type="hidden" id="article_id" name="article_id">
                            <div class="form-container p-4 mb-2 text-start">
                                <div class="row g-3 mb-3">
                                    <div class="col-md-12">
                                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter the Title of the Article" >
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-md-12">
                                        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="content" name="content" placeholder="Enter Content" rows="5" ></textarea>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-md-4">
                                        <label for="date_published" class="form-label">Date Published<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="date_published" name="date_published" >
                                    </div>
                                    <div class="col-md-8">
                                        <label for="source_url" class="form-label">Source URL<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="source_url" name="source_url" placeholder="Enter Source URL" >
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-md-12">
                                        <label for="comment" class="form-label">Comment</label>
                                        <textarea class="form-control" id="comment" name="comment" placeholder="Enter Comment" rows="2"></textarea>
                                    </div>
                                </div>

                            </div>
                            <!--Buttons-->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <!-- Category -->
                                <div class="w-50">
                                    <select class="form-select form-select-md" name="CATEGORY_category_id" aria-label="Category selection" >
                                        <option value="" selected disabled>Select Category</option>
                                        <?php
                                        include "../../config.php";
                                        $categoryQuery = "SELECT * FROM category";
                                        $categoryResult = $conn->query($categoryQuery);

                                        while ($category = $categoryResult->fetch_assoc()) {
                                            echo "<option value='{$category['category_id']}'>{$category['name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="d-flex gap-2 w-auto">
                                    <a class="btn btn-danger px-4" href="user_dashboard.php" type="button">Cancel</a>
                                    <input class="btn px-5 buttonBrand " type="submit" value="Submit">

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--script-->
    <script src="../../scripts/script.js"></script>
    <script src="../../scripts/user_script.js"></script>
</body>