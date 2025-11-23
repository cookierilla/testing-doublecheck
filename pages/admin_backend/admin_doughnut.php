<?php 
include "../../config.php";

$sql = "SELECT 
            SUM(status = 'pending') AS pending_count,
            SUM(status = 'approved') AS approved_count,
            SUM(status = 'rejected') AS rejected_count
        FROM article";

$result = $conn->query($sql);

$data = ['pending' => 0, 'approved' => 0, 'rejected' => 0];

if ($row = $result->fetch_assoc()) {
    $data['pending'] = (int)$row['pending_count'];
    $data['approved'] = (int)$row['approved_count'];
    $data['rejected'] = (int)$row['rejected_count'];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
