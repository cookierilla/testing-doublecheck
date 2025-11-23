<?php
include "../../config.php";
session_start();

header('Content-Type: application/json');

// Check if user is authenticated
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized access."]);
    exit;
}

// Validate inputs
if (!isset($_POST['article_id'], $_POST['status'], $_POST['source_reliable'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields."]);
    exit;
}

$article_id = (int) $_POST['article_id']; // Cast to integer
$status = mysqli_real_escape_string($conn, $_POST['status']);
$source_reliable = mysqli_real_escape_string($conn, $_POST['source_reliable']);
$detection_result = $source_reliable === 'Yes' ? 'real' : 'fake';

$user_id = (int) $_SESSION['user_id'];

date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d H:i:s");

// --- Update ARTICLE ---
$update_query = "
    UPDATE ARTICLE
    SET status = '$status',
        detection_result = '$detection_result'
    WHERE article_id = $article_id
";

if (!$conn->query($update_query)) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to update article."]);
    exit;
}

// --- Log activity ---
$action = mysqli_real_escape_string($conn, 'Article Tagged');
$details = mysqli_real_escape_string($conn, "Article ID $article_id tagged with status '$status' and detection_result '$detection_result'");

$log_query = "
    INSERT INTO ACTIVITY_LOG (action, timestamp, details, USER_user_id)
    VALUES ('$action', '$timestamp', '$details', $user_id)
";

if (!$conn->query($log_query)) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to log activity."]);
    exit;
}

// --- Success Response ---
echo json_encode(["message" => "Article tagged and activity logged successfully."]);

// --- Save matched fake news keywords (duplicates allowed) ---
$matched_keywords_json = $_POST['matched_keywords'] ?? '[]';
$matched_keyword_ids = json_decode($matched_keywords_json, true);

if (is_array($matched_keyword_ids)) {
    foreach ($matched_keyword_ids as $keyword_id) {
        $keyword_id = (int) $keyword_id;

        // Direct insert without duplicate check
        $conn->query("
            INSERT INTO article_keyword (ARTICLE_article_id, KEYWORD_keyword_id)
            VALUES ($article_id, $keyword_id)
        ");
    }
}
?>
