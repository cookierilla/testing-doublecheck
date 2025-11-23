<?php
include "../../config.php";
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

// Load keywords and their IDs
$keyword_map = []; // word => keyword_id
$keyword_result = $conn->query("SELECT keyword_id, word FROM keyword");

while ($row = $keyword_result->fetch_assoc()) {
    $keyword_map[strtolower(trim($row['word']))] = $row['keyword_id'];
}

// Combine title and content
$full_text = strtolower(strip_tags($article['title'] . ' ' . $article['content']));
$words = preg_split('/[\s,.\'";:!?()\-]+/', $full_text, -1, PREG_SPLIT_NO_EMPTY);

// Count and collect matched keyword IDs (with duplicates)
$keyword_match_count = 0;
$matched_keyword_ids = [];

foreach ($words as $word) {
    $lower_word = strtolower(trim($word));
    if (isset($keyword_map[$lower_word])) {
        $keyword_match_count++;
        $matched_keyword_ids[] = $keyword_map[$lower_word];
    }
}

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
    <title>Review <?= htmlspecialchars($article['title']) ?> | Double-Check</title>

    <!-- CSS & JS Imports -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/styles.css">
    <link rel="stylesheet" href="../../assets/navbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<script>
    var matchedKeywordIds = <?= json_encode($matched_keyword_ids) ?>;
</script>

<body>
    <div class="menu">
        <?php include "../../pages/include_elements/admin_navbar.php"; ?>
    </div>

    <div id="main-content-wrapper">
        <div class="row row-cols-1 row-cols-md-2 g-3 mt-5 p-4 poppins-regular">

            <!-- Article Card -->
            <div class="col-md-9 col-12 d-flex">
                <div class="card h-100 w-100 shadow">
                    <div class="card-body p-5">
                        <div class="container-fluid text-center mb-5">
                            <p class="card-text" id="date_published">Date Published: <?= $article['date_published'] ?></p>
                            <h1 class="card-title epilogue" id="title"><?= htmlspecialchars($article['title']) ?></h1>
                            <h6 class="card-text">Category: <?= htmlspecialchars($article['category_name']) ?></h6>
                            <p class="card-text">Submitted by: <?= htmlspecialchars($article['username']) ?></p>
                        </div>
                        <hr>
                        <div class="container-fluid mb-5">
                            <p class="card-text" id="content"><?= nl2br(htmlspecialchars($article['content'])) ?></p>
                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <div class="container-fluid text-center mb-3">
                            <a class="btn btn-primary" href="<?= htmlspecialchars($article['source_url']) ?>" target="_blank">Source URL</a>
                        </div>
                        <div class="container-fluid">
                            <label for="comment" class="form-label">User Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" readonly><?= htmlspecialchars($comment_content) ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-3 col-12 d-flex flex-column align-items-start">
                <div class="row row-cols-1 row-cols-md-2 g-3">

                    <!-- Keyword Count Card -->
                    <div class="col-md-12 col-12 d-flex">
                        <div class="card text-center h-100 w-100 shadow">
                            <div class="card-body">
                                <h1 class="card-title" id="percentage">Select reliability</h1>
                                <h3 class="card-title" id="label"></h3>
                                <hr>
                                <div class="container-fluid p-3">
                                    <div>
                                        <h3 class="card-text" id="keywordCount"><?= $keyword_match_count ?></h3>
                                        <p>Fake News Keywords Detected</p>
                                    </div>
                                    <hr>
                                    <div>
                                        <img id="dateImage" src="" class="img-icon" alt="icon">
                                        <p>5 Year Publication Date Relevance</p>
                                    </div>
                                    <hr>
                                    <div>
                                        <form id="radio_source">
                                            <input type="radio" class="form-check-input radio_btn" name="source_reliable" value="Yes" id="radio_btn_yes">
                                            <label class="form-check-label" for="radio_btn_yes">Yes &emsp;</label>
                                            <input type="radio" class="form-check-input radio_btn" name="source_reliable" value="No" id="radio_btn_no">
                                            <label class="form-check-label" for="radio_btn_no">No</label>
                                            <p>Source URL is Reliable</p>
                                        </form>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Article Status -->
                    <div class="col-md-12 col-12 d-flex">
                        <div class="card text-center w-100 shadow">
                            <div class="card-body text-center h-25">
                                <select class="form-select form-select-md mb-3" id="status_select">
                                    <option value="pending" <?= $article['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="rejected" <?= $article['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                    <option value="approved" <?= $article['status'] == 'approved' ? 'selected' : '' ?>>DOUBLE CHECKED✔✔</option>
                                </select>
                            </div>
                            <div class="card-body text-center h-25">
                                <select class="form-select form-select-md mb-3" id="detection_result_select">
                                    <option value="fake" <?= $article['detection_result'] == 'fake' ? 'selected' : '' ?>>Fake</option>
                                    <option value="real" <?= $article['detection_result'] == 'real' ? 'selected' : '' ?>>Real</option>
                                </select>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-md w-100 buttonBrand" type="button" id="tag_article_btn" data-article-id="<?= $article_id ?>">Tag Article</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script>
        console.log("Keyword Count Text:", $("#keywordCount").text());
    </script>
    <script src="../../scripts/script.js"></script>
    <script src="../../scripts/article_script.js"></script>
    <script src="../../scripts/admin_review.js"></script>
</body>

</html>