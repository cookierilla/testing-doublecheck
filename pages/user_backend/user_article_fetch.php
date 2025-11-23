<?php
include "../../config.php";
session_start();

$status = $_POST['status_name'] ?? '';
$user_id = $_SESSION['user_id'];

$query = "
    SELECT 
        article.*, 
        category.name AS category_name,
        user.user_id
    FROM article
    LEFT JOIN category ON article.Category_category_id = category.category_id
    LEFT JOIN user ON article.User_user_id = user.user_id
    WHERE User.user_id = $user_id
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
            <td>{$row['title']}</td>
            <td>{$row['date_published']}</td>
            <td>{$row['category_name']}</td>
            <td>{$row['submission_date']}</td>
            <td class='capital'>{$row['status']}</td>

            <td>
                <a href='../user/user_review_article_page.php?id={$row['article_id']}' class='btn buttonBrandv2' 
                >Review</a>
               <button class='btn btn-danger deleteBtn' 
                    data-id='{$row['article_id']}'>Delete</button>
            </td>
            
            <td class='capital'>{$row['detection_result']}</td>   


            
        </tr>";
}

echo $output;
