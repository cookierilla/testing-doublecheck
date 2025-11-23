<?php include "../../config.php";
include "../login/session_auth.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles | Double-Check</title>

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

        <div class="container-fluid mt-5 px-3 epilogue">
            <h1 class="titles">Let's Double-Check those Headlines</h1>
        </div>
        <div class="container-fluid p-3 poppins-regular">
            <div class="card text-center h-100 w-100 shadow">
                <div class="card-body ">

                    <div class="card-title">
                        <div class="row row-cols-1 row-cols-md-2 g-3">
                            <!--Search bar-->
                            <div class="col-md-8 col-12 d-flex">
                                <!--Search Button to open modal-->
                                <div class="col-md-10 col-12 d-flex">
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal">Search</button>
                                </div>
                            </div>

                            <!--Status Filter Box-->
                            <div class="col-md-3 col-12 d-flex">
                                <select id="status_filter" class="form-select form-select-md" aria-label=".form-select-lg example">
                                    <option>All</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>

                            <!--Export Button-->
                            <div class="col-md-1 col-12 d-flex">
                                <a class="btn btn-md w-100 buttonSecondary" id="exportArticleBtn">Export</a>
                            </div>
                        </div>
                    </div>

                    <div class="big-scrollable-table table-responsive-sm" style="overflow-x: auto;">
                        <table class="table table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Submitted By</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Source URL</th>
                                    <th scope="col">Date Published</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Submission Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Detection Results</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="articlesTable">
                                <!-- Articles list will be loaded here via AJAX -->
                            </tbody>
                        </table>
                    </div>

                    <?php include "../admin_backend/article_search_modal.php"; ?>

                    <div class="card-footer">
                        <small class="epilogue">Because the truth matters—and it's worth double-checking.</small>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--scripts-->
    <script src="../../scripts/script.js"></script>
    <script src="../../scripts/article_script.js"></script>
    <script src="../../scripts/export.js"></script>
</body>


</html>