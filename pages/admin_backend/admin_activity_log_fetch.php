<?php
include "../../config.php";

$query = "
    SELECT 
        activity_log.*, 
        user.username
    FROM activity_log
    LEFT JOIN user ON activity_log.USER_user_id = user.user_id
    WHERE 1
";

$query .= " ORDER BY activity_log.log_id DESC";

$result = $conn->query($query);
$output = "";
while ($row = $result->fetch_assoc()) {
    $output .= "
        <tr>
            <td>{$row['log_id']}</td>
            <td>{$row['action']}</td>
            <td>{$row['timestamp']}</td>
            <td>{$row['details']}</td>
            <td>{$row['username']}</td>
        </tr>";
}

echo $output;
