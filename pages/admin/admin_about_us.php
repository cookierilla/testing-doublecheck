<?php include "../../config.php"; 
include "../login/session_auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Double-Check</title>

    <!--Boostrap 5, Icons, and CSS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/styles.css">
    <link rel="stylesheet" href="../../assets/footer.css">
    <link rel="stylesheet" href="../../assets/navbar.css">
    <link rel="stylesheet" href="../../assets/about_us.css">

    <!--JQuery and Chart.js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!--Google Fonts-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,600;1,600&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap');
    </style>
</head>

<body>
    <!-- navbar -->
    <?php include "../../pages/include_elements/admin_navbar.php"; ?>

    <div id="main-content-wrapper">

        <div class="content-area">

            <section class="hero-section">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center mb-4">
                            <img class="img-brand" src="../../assets/images/Logo-Two.png" alt="logo">
                        </div>
                        <div class="col-12 text-center mb-4">
                            <h1 class="hero-title inter">Say Hello to Double-Check</h1>
                        </div>
                        <div class="col-lg-8 text-center">
                            <p class="hero-text poppins-medium">
                                In a world overflowing with headlines, hot takes, and half-truths, separating fact from fiction has never been more important—or more difficult. That's why we built Double-Check: a smart, simple tool that helps you spot fake news before it spreads.
                            </p>
                            <p class="hero-text poppins-medium">
                                Powered by advanced AI and backed by real human insight, Double-Check analyzes news content in real time to flag misinformation, highlight biased sources, and empower readers to make informed decisions.
                            </p>
                            <p class="hero-text mb-0 poppins-medium">
                                But we're not just about algorithms—we're about trust, transparency, and giving people the tools they need to navigate the digital world with confidence.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="team-section">
                <div class="container-fluid">

                    <div class="row justify-content-center mb-5">
                        <div class="col-12">
                            <h2 class="team-title inter">Meet the Team Behind Double-Check</h2>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-stretch">
                        <div class="col-md-6 col-lg-2 mb-4">
                            <img class="team-member-placeholder highlight" src="../../assets/images/Ralph.jpg"></img>
                            <div class="team-member-info poppins-regular">
                                <span class="role">Lead Developer</span>
                                <div class="name">Ralph De Guzman</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2 mb-4">
                            <img class="team-member-placeholder highlight" src="../../assets/images/drys.jpg"></img>
                            <div class="team-member-info poppins-regular">
                                <span class="role">Front-End Developer</span>
                                <div class="name">Drystan Bernardo</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2 mb-4">
                            <img class="team-member-placeholder highlight" src="../../assets/images/Buds.jpg"></img>
                            <div class="team-member-info poppins-regular">
                                <span class="role">Back-End Developer</span>
                                <div class="name">Edzi Escoto</div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="team-description-box">
                                <p class="poppins-regular">
                                    We're a curious crew who believe the truth deserves a fighting chance. We've come together to build something that helps everyone see through the noise.
                                </p>
                                <a class="btn team-articles-button" href="admin_articles_dashboard.php">Double-Check Articles Now!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    <!-- footer -->
    <?php include "../../pages/include_elements/footer.php"; ?>
    </div>
    <div class="scroll-buttons">
        <button id="scroll-down-btn" title="Scroll Down"><i class="fas fa-arrow-down"></i></button>
        <button id="scroll-up-btn" title="Scroll Up"><i class="fas fa-arrow-up"></i></button>
    </div>

    </div>
    <script src="../../scripts/script.js"></script>
</body>

</html>