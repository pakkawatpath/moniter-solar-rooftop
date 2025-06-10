<?php

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Round;

include_once($_SERVER['DOCUMENT_ROOT'] . "/moniter_solar_rooftop/db.php");

// ตั้งค่าโซนเวลา
date_default_timezone_set("Asia/Bangkok");

$location_id = $_GET['location_id'];

// ตรวจสอบค่าของ $location_id เพื่อป้องกัน SQL Injection
$location_id = mysqli_real_escape_string($conn, $location_id);

// คำสั่ง SQL สำหรับดึงข้อมูล 1 ชั่วโมงก่อนหน้าจนถึงปัจจุบัน
$sql = "SELECT 
            lsl.datetime, 
            el.P, 
            el.Psum, 
            lsl.power_manufacture, 
            lsl.irradiation, 
            SUM(invl.active_power) AS suminv
        FROM location_site_log lsl
        INNER JOIN edmi_log el 
            ON lsl.datetime = el.datetime 
            AND el.location_id = lsl.location_id
        INNER JOIN inverter_log invl 
            ON lsl.datetime = invl.datetime 
            AND invl.location_id = lsl.location_id
        WHERE lsl.location_id = '$location_id' 
            AND lsl.datetime >= NOW() - INTERVAL 1 HOUR
        GROUP BY lsl.datetime, el.P, el.Psum, lsl.power_manufacture, lsl.irradiation
        ORDER BY lsl.datetime ASC";

$result = $conn->query($sql);
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $powertotal = Round($row['power_manufacture'] + $row['suminv'], 2);
        $solar = Round($row['suminv'], 2);
        $pea = Round($row['power_manufacture'], 2);
        $irr = Round($row['irradiation'], 2);

        $data[] = [
            'date' => $row['datetime'],
            'line1' => (float) $powertotal, // รวมพลังงานทั้งหมด
            'line2' => (float) $solar, // พลังงานจาก Solar
            'line3' => (float) $pea, // พลังงานจาก PEA
            'line4' => (float) $irr // ค่าการแผ่รังสี
        ];
    }
}

// ส่งข้อมูลออกเป็น JSON
echo json_encode($data);

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
