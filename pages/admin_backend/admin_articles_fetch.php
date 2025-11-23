<?php
include "../../config.php";

$status = $_POST['status_name'] ?? '';

$query = "
    SELECT 
        article.*, 
        category.name AS category_name,
        user.username
    FROM article
    LEFT JOIN category ON article.Category_category_id = category.category_id
    LEFT JOIN user ON article.User_user_id = user.user_id
    WHERE 1
";

if (!empty($status) && $status != 'All') {
    $query .= " AND article.status = '$status'";
}

$query .= " ORDER BY article.article_id DESC";

$result = $conn->query($query);
$output = "";
while ($row = $result->fetch_assoc()) {
    $output .= "
        <tr>
            <td>{$row['article_id']}</td>
            <td>{$row['username']}</td>
            <td>{$row['title']}</td>
            <td>{$row['source_url']}</td>
            <td>{$row['date_published']}</td>
            <td>{$row['category_name']}</td>
            <td>{$row['submission_date']}</td>
            <td class='capital'>{$row['status']}</td>
            <td class='capital'>{$row['detection_result']}</td>

            <td>
                <a href='../admin/admin_review_article_page.php?id={$row['article_id']}' class='btn buttonBrandv2 m-1' 
                >Review</a>
            </td>
            
        </tr>";
}

echo $output;
