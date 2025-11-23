<?php include "../../config.php";
include "../login/session_auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Double-Check</title>

    <!--Boostrap 5, Icons, and CSS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/styles.css">
    <link rel="stylesheet" href="../../assets/navbar.css">

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
        <?php include "../../pages/include_elements/admin_navbar.php"; ?>
    </div>

    <!-- Main Content -->
    <div id="main-content-wrapper">
        <!-- Header -->
        <?php include "../../pages/include_elements/header.php"; ?>

        <!-- Start of Content -->
        <!--Row Cards-->
        <div class="row row-cols-1 row-cols-md-2 g-2 p-3">
            <!--Title-->
            <div class="col-12 mt-3 d-flex">
                <h1 class="titles epilogue">You're in. Let's Double-Check the Data</h1>
            </div>

            <!--Line Chart Container 1-->
            <div class="col-md-9 col-12 d-flex">
                <div class="card text-center h-auto w-100 shadow">
                    <div class="card-body poppins-regular">
                        <div>
                            <canvas id="barChart"></canvas>
                        </div>
                        <h5 class="card-title">Fake News Detection Rate</h5>
                        <p class="card-text">Number of Double-Checked Real and Fake News Articles.</p>
                    </div>
                </div>
            </div>

            <!--Donut Chart Container 2-->
            <div class="col-md-3 col-12 d-flex">
                <div class="card text-center h-auto w-100 shadow">
                    <div class="card-body poppins-regular">
                        <div>
                            <canvas id="doughnutChart"></canvas>
                        </div>
                        <h5 class="card-title">Article Count by Status</h5>
                        <br><br>
                        <p class="card-text">Number of Current Pending, Rejected and Double-Checked Articles.</p>
                    </div>
                </div>
            </div>

            <!--Categories Container 3-->
            <div class="col-md-3 col-12 d-flex">
                <div class="card text-center shadow">
                    <div class="card-body poppins-regular">
                        <h5 class="card-title epilogue">Categories</h5>
                        <hr>
                        <!--table-->
                        <div class="scrollable-table table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Category ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="categoryTable">
                                    <!-- Category list will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="">
                            <button type="button" class="btn buttonBrand" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                                + Add New Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!--Bar Graph Container 4-->
            <div class="col-md-9 col-12 d-flex">
                <div class="card text-center h-auto w-100 shadow">
                    <div class="card-body poppins-regular">
                        <div>
                            <canvas id="keywordRadarChart"></canvas>
                        </div>
                        <h5 class="card-title">Top Trending Fake News Keywords</h5>
                        <p class="card-text">This radar chart displays frequently occurring keywords in flagged articles.</p>
                    </div>
                </div>
            </div>

            <!--Activity LogsTable-->
            <div class="col-md-12 col-12 d-flex">
                <div class="card text-center h-auto w-100 p-3 shadow">
                    <h1 class="pt-4 epilogue">Activity Logs</h1>
                    <hr>
                    <div class="card-body poppins-regular">
                        <div class="big-scrollable-table table-responsive-md" style="overflow-x: auto;">
                            <table class="table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Log ID</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Timestamp</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Username</th>
                                    </tr>
                                </thead>
                                <tbody id="logTable">

                                    <!-- Activity Log list will be loaded here via AJAX -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "../admin_backend/admin_category_modal.php"; ?>
        <?php include "../admin_backend/admin_category_edit_modal.php"; ?>



        <!--scripts-->
        <script src="../../scripts/charts.js"></script>
        <script src="../../scripts/category_script.js"></script>
        <script src="../../scripts/article_script.js"></script>
        <script src="../../scripts/activity_log.js"></script>
</body>

</html>