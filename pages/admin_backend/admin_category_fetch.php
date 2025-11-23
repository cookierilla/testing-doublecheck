<?php

include "../../config.php";

$query = "SELECT * FROM category";
$result = $conn->query($query);

$output = "";
while ($row = $result->fetch_assoc()) {
    $output .= "
        <tr>
            <td>{$row['category_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['description']}</td>

            <td>
                <button class='btn btn-warning btn-sm editBtn' 
                    data-category_id='{$row['category_id']}'
                    data-name='{$row['name']}'
                    data-description='{$row['description']}'
                >Edit</button>
            </td>
            <td>
               <button class='btn btn-danger btn-sm deleteBtn' 
                    data-id='{$row['category_id']}'>Delete</button>
            </td>
        </tr>";
}

echo $output;