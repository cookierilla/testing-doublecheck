<?php
include "../../config.php";
$search = $_GET['search'] ?? '';
$query = "
    SELECT 
        article.*, 
        category.name AS category_name,
        user.username
    FROM article
    LEFT JOIN category ON article.Category_category_id = category.category_id
    LEFT JOIN user ON article.User_user_id = user.user_id
";

if (!empty($search)) {
    $query .= " WHERE 
        article_id LIKE '%$search%' OR
        title LIKE '%$search%' OR
        submission_date LIKE '%$search%'
        ORDER BY article_id DESC";
} else {
    $query .= " ORDER BY article_id DESC";
}

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
            <td>{$row['status']}</td>

            <td>
                <a href='../user/user_review_article_page.php?id={$row['article_id']}' class='btn buttonBrandv2' 
                >Review</a>
               <button class='btn btn-danger deleteBtn' 
                    data-id='{$row['article_id']}'>Delete</button>
            </td>
            
            <td>{$row['detection_result']}</td>   


            
        </tr>";
}

echo $output;
