<?php
include_once "db.php";

require_once 'vendor/autoload.php';

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];
$id = $_GET['id'];

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'DateTime');
$sheet->setCellValue('B1', 'Load total');
$sheet->setCellValue('C1', 'Sum inverter');
$sheet->setCellValue('D1', 'Sum PQM');
$sheet->setCellValue('E1', 'IRR');
$sheet->setCellValue('F1', 'Ambtemp');
$sheet->setCellValue('G1', 'ModuleTemp');
$sheet->setCellValue('H1', 'Wind');
$sheet->setCellValue('I1', 'PowerINVsum');
$sheet->setCellValue('J1', 'TOU');
$sheet->setCellValue('K1', 'Peak Day');
$raw = mysqli_query($conn, "SELECT count(*) as COUNT FROM `inverter` WHERE `location_id` = '$id'");
while ($row = $raw->fetch_array()) {
    $count = $row['COUNT'];
    for ($i = 1; $i <= $count; $i++) {
        $num = 75 + $i;
        $x = chr($num) . '1';
        $sheet->setCellValue($x, 'Eng_INV' . $i);
    }
}





// echo $date1 . " " . $date2;

$query = "SELECT STRAIGHT_JOIN lsl.datetime, lsl.power_manufacture, SUM(invl.active_power) AS suminv, lsl.irradiation, 
            lsl.ambient_temp, lsl.module, lsl.wind_speed, SUM(invl.Etoday) AS sumenergy, el.TOU
            FROM location_site_log AS lsl
            INNER JOIN inverter_log AS invl ON lsl.datetime = invl.datetime
            INNER JOIN edmi_log AS el ON lsl.datetime = el.datetime
            WHERE lsl.location_id = '$id' and invl.location_id = '$id' and el.location_id = '$id' AND lsl.datetime BETWEEN '$date1 00:00:00' AND '$date2 23:59:59'
            GROUP BY lsl.datetime, lsl.power_manufacture, lsl.irradiation, lsl.ambient_temp, lsl.module, lsl.wind_speed, el.TOU
            ORDER BY lsl.datetime DESC";
$result = mysqli_query($conn, $query);
$row = 2;

while ($row_data = $result->fetch_array()) {
    $sheet->setCellValue('A' . $row, $row_data['datetime']);
    $sheet->setCellValue('B' . $row, $row_data['power_manufacture'] + $row_data['suminv']);
    $sheet->setCellValue('C' . $row, $row_data['suminv']);
    $sheet->setCellValue('D' . $row, $row_data['power_manufacture']);
    $sheet->setCellValue('E' . $row, $row_data['irradiation']);
    $sheet->setCellValue('F' . $row, $row_data['ambient_temp']);
    $sheet->setCellValue('G' . $row, $row_data['module']);
    $sheet->setCellValue('H' . $row, $row_data['wind_speed']);
    $sheet->setCellValue('I' . $row, $row_data['sumenergy']);
    $sheet->setCellValue('J' . $row, $row_data['TOU']);
    $sheet->setCellValue('K' . $row, $row_data['TOU']);
    $datetime = $row_data['datetime'];
    $sql = "SELECT * FROM `inverter_log` WHERE `datetime` = '$datetime' AND  `location_id` = '$id'";
    // echo $sql;
    $rawy = mysqli_query($conn, $sql);
    $num = 76;
    while ($rowy = $rawy->fetch_array()) {
        $x = chr($num) . $row;
        $sheet->setCellValue($x, $rowy['Etoday']);
        // echo $num;
        // echo $rowy['Etoday'];
        // echo $x;
        $num++;
    }
    $row++;
}
$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);
$sheet->getColumnDimension('I')->setAutoSize(true);
$sheet->getColumnDimension('j')->setAutoSize(true);
$sheet->getColumnDimension('K')->setAutoSize(true);

$filename = $date1 . " to " . $date2 . ".xlsx";

$writer = new Xlsx($spreadsheet);
$writer->save($filename);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
readfile($filename);
unlink($filename);
exit;
