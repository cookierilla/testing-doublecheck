<?php include "../../config.php";
include "../login/session_auth.php";

$article_id = $_GET['id'] ?? 0;

// Fetch article data
$query = "
    SELECT a.*, u.username, c.name AS category_name
    FROM article a
    LEFT JOIN user u ON a.USER_user_id = u.user_id
    LEFT JOIN category c ON a.CATEGORY_category_id = c.category_id
    WHERE a.article_id = $article_id
";

$result = $conn->query($query);
$article = $result->fetch_assoc();

// Fetch latest comment
$comment_query = "
    SELECT c.content
    FROM COMMENT c
    WHERE c.ARTICLE_article_id = $article_id
    ORDER BY c.created_at DESC
    LIMIT 1
";

$comment_result = $conn->query($comment_query);
$comment = $comment_result->fetch_assoc();
$comment_content = $comment['content'] ?? 'No comments available.';

// Load keywords from DB
$fake_keywords = [];
$keyword_result = $conn->query("SELECT word FROM keyword");

while ($row = $keyword_result->fetch_assoc()) {
    $fake_keywords[] = strtolower(trim($row['word']));
}

// Combine title and content
$full_text = strtolower(strip_tags($article['title'] . ' ' . $article['content']));

// Tokenize text
$words = preg_split('/[\s,.\'";:!?()\-]+/', $full_text, -1, PREG_SPLIT_NO_EMPTY);

// Count matched keywords (unique or total, you can pick)
$keyword_match_count = 0;
foreach ($words as $word) {
    if (in_array($word, $fake_keywords)) {
        $keyword_match_count++;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> | Double-Check</title>

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
        <?php include "../../pages/include_elements/navbar.php"; ?>
    </div>

    <!-- Main Content -->
    <div id="main-content-wrapper">
        <!-- Start of Content -->
        <!--Row One Cards-->
        <div class="row row-cols-1 row-cols-md-2 g-3 mt-5 p-4 poppins-regular">

            <!--Content-->
            <div class="col-md-9 col-12 d-flex">
                <div class="card h-100 w-100 shadow">
                    <div class="card-body p-5">
                        <div class="container-fluid text-center mb-5">
                            <p class="card-text" id="date_published">Date Published: <?php echo htmlspecialchars($article['date_published']); ?></p>
                            <h1 class="card-title epilogue" id="title"><?php echo htmlspecialchars($article['title']); ?></h1>
                            <h6 class="card-text" id="submitted_by">Category: <?= $article['category_name'] ?></h6>
                            <p class="card-text" id="submitted_by">Submitted by: <?php echo htmlspecialchars($article['username']); ?></p>
                        </div>
                        <hr>
                        <div class="container-fluid mb-5">
                            <p class="card-text text-justify" id="content"><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <div class="container-fluid text-center">
                            <a href="<?php echo htmlspecialchars($article['source_url']); ?>" class="btn btn-primary" id="source_url" target="_blank">Source URL</a>
                        </div>
                        <div class="container-fluid">
                            <label for="comment" class="form-label">User Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" readonly><?= htmlspecialchars($comment_content) ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12 d-flex flex-column align-items-start">
                <!--Row Two Cards-->
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    <!--Container 2-->
                    <div class="col-md-12 col-12 d-flex">
                        <div class="card text-center h-100 w-100 shadow">
                            <div class="card-body">
                                <h1 class="card-title" id="detection"><?php echo ucfirst($article['detection_result']); ?></h1>
                                <h4 class="poppins-regular">Detection Result</h4>
                                <hr>
                                <div class="container-fluid p-3">
                                    <!--Keywords Panel-->
                                    <div>
                                        <h3 class="card-text" id="keywordCount"><?= $keyword_match_count ?></h3>
                                        <p>Fake News Keywords Detected</p>
                                    </div>
                                    <hr>
                                    <!--Date Publication Panel-->
                                    <div>
                                        <img id="dateImage" src="" class="img-icon" alt="icon">
                                        <p>5 Year Publication Date Relevance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Container 3-->
                    <div class="col-md-12 col-12 d-flex">
                        <div class="card text-center w-100 shadow">
                            <div class="card-body text-center h-25">
                                <input class="form-control text-center" type="text" value="<?php echo ucfirst($article['status']); ?>" readonly>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-md w-100 editBtn buttonSecondary"
                                    type="button"
                                    data-article_id="<?php echo $article['article_id']; ?>"
                                    data-title="<?php echo htmlspecialchars($article['title']); ?>"
                                    data-content="<?php echo htmlspecialchars($article['content']); ?>"
                                    data-source_url="<?php echo htmlspecialchars($article['source_url']); ?>"
                                    data-date_published="<?php echo htmlspecialchars($article['date_published']); ?>"
                                    data-category_id="<?php echo $article['CATEGORY_category_id']; ?>">
                                    Edit
                                </button>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-md w-100 btn-danger deleteBtn"
                                    type="button"
                                    data-id="<?php echo $article['article_id']; ?>">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--script-->
    <script src="../../scripts/script.js"></script>
    <script src="../../scripts/user_script.js"></script>
    <script src="../../scripts/admin_review.js"></script>

    <?php include "../user_backend/user_article_edit_modal.php"; ?>
</body>

</html>