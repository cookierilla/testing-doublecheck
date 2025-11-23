<?php
include "../../config.php";

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$query = "SELECT * FROM user";

if (!empty($search)) {
    $query .= " WHERE 
        user_id LIKE '%$search%' OR
        username LIKE '%$search%' OR 
        first_name LIKE '%$search%' OR 
        last_name LIKE '%$search%' OR 
        middle_name LIKE '%$search%' OR
        email LIKE '%$search%' OR 
        age LIKE '%$search%' OR 
        phone_number LIKE '%$search%' OR 
        admin_role LIKE '%$search%' 
        ORDER BY user_id DESC";
} else {
    $query .= " ORDER BY user_id DESC";
}

$result = $conn->query($query);

$output = "";
while ($row = $result->fetch_assoc()) {
    $output .= "
        <tr>
            <td>{$row['user_id']}</td>
            <td>{$row['username']}</td>
            <td>{$row['first_name']}</td>
            <td>{$row['last_name']}</td>
            <td>{$row['middle_name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['age']}</td>
            <td>{$row['phone_number']}</td>
            <td>{$row['password_hash_md5']}</td>
            <td class='capital'>{$row['admin_role']}</td>
            <td>
                <button class='btn btn-warning btn-sm editBtn' 
                    data-user_id='{$row['user_id']}'
                    data-username='{$row['username']}'
                    data-firstname='{$row['first_name']}'
                    data-lastname='{$row['last_name']}'
                     data-middlename='{$row['middle_name']}'
                    data-email='{$row['email']}'
                   data-age='{$row['age']}'
                    data-phone='{$row['phone_number']}'
                    data-role='{$row['admin_role']}'
                   >Edit</button>

               <button class='btn btn-danger btn-sm deleteBtn' 
                    data-id='{$row['user_id']}'>Delete</button>
            </td>
        </tr>";
}

echo $output;