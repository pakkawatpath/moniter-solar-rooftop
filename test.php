<?php

include_once 'db.php';
$location_id = $_GET['location_id'];

$sql = "SELECT COUNT(*) as Number FROM `inverter` WHERE `location_id` = '$location_id'";

$result = $conn->query($sql);
echo $sql;
$rowcount = $result->fetch_array();
echo $rowcount['Number'];


// ดึงข้อมูลจากฐานข้อมูล
date_default_timezone_set("Asia/Bangkok");
$datetime = date("Y-m-d") . '%';

$sql = "SELECT dp.id, ls.datetime, ls.power_total, ls.solar_accumulated
FROM location_site ls
INNER JOIN inverter inv ON ls.location_id = inv.location_id
INNER JOIN data_power dp ON inv.inverter_id = dp.inverter_id
WHERE ls.location_id = '1'
ORDER BY ls.datetime ASC limit 1;
";

// $sql = "SELECT * FROM `test` WHERE `datetime` LIKE '$datetime' ORDER BY `id` DESC";

$result = $conn->query($sql);
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'date' => $row['datetime'],
            'line1' => (float) sprintf("%.3f", $row['power_total'] / 1000),
            'line2' => (float) sprintf("%.3f", $row['solar_accumulated'] / 1000),
            'line3' => (float) 0,
            'line4' => (float) 0
        ];
    }
}

echo json_encode($data);

$conn->close();
