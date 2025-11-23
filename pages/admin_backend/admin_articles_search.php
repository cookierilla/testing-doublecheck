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
        username LIKE '%$search%' OR
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
            <td>{$row['username']}</td>
            <td>{$row['title']}</td>
            <td>{$row['source_url']}</td>
            <td>{$row['date_published']}</td>
            <td>{$row['category_name']}</td>
            <td>{$row['submission_date']}</td>
            <td>{$row['status']}</td>
            <td>{$row['detection_result']}</td>

            <td>
                <button class='btn btn-warning btn-sm editBtn' 
                    data-article_id='{$row['article_id']}'
                    data-title='{$row['title']}'
                    data-source_url='{$row['source_url']}'
                    data-date_published='{$row['date_published']}'
                    data-category='{$row['category_name']}'
                    data-detection_result='{$row['detection_result']}'
                >Edit</button>
               <button class='btn btn-danger btn-sm deleteBtn' 
                    data-id='{$row['article_id']}'>Delete</button>
            </td>
            
        </tr>";
}

echo $output;
