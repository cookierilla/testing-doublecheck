<?php include "../../config.php";

$sql = "SELECT 
            SUM(detection_result = 'real') AS real_count,
            SUM(detection_result = 'fake') AS fake_count
        FROM article";

$result = $conn->query($sql);

$data = ['real' => 0, 'fake' => 0];

if ($row = $result->fetch_assoc()) {
    $data['real'] = (int)$row['real_count'];
    $data['fake'] = (int)$row['fake_count'];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
