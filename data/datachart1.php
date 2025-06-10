<?php

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Round;

include_once($_SERVER['DOCUMENT_ROOT'] . "/moniter_solar_rooftop/db.php");

$obj = array();

$color003b75 = '#0065c7';
$color85baf0 = '#85baf0';
$colorc9e2ff = '#c9e2ff';
$coloreaf3fa = '#eaf3fa';
$color2a9001 = '#2a9001';
$color7bc6a5 = '#7bc6a5';
$colorc0e5d4 = '#c0e5d4';

static $location_id = null;

$location_id = $_GET['location_id'];

$sql = "SELECT COUNT(*) as Number FROM `inverter` WHERE `location_id` = '$location_id'";
$result = $conn->query($sql);
$rowcount = $result->fetch_array();

$num = $rowcount['Number'];

function rand_color()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

for ($i = 1; $i <= $num; $i++) {
    if ($i == 1) {
        $color = $color003b75;
    } elseif ($i == 2) {
        $color = $color85baf0;
    } elseif ($i == 3) {
        $color = $colorc9e2ff;
    } elseif ($i == 4) {
        $color = $coloreaf3fa;
    } elseif ($i == 5) {
        $color = $color2a9001;
    } elseif ($i == 6) {
        $color = $color7bc6a5;
    } elseif ($i == 7) {
        $color = $colorc0e5d4;
    }

    $sql1 = "SELECT sum(Etoday) as sumetoday FROM `inverter` WHERE `location_id` = '$location_id'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_array();

    $sql = "SELECT Etoday FROM `inverter` WHERE `number` = '$i' and `location_id` = '$location_id'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $x = Round($row['Etoday'] / $row1['sumetoday'] * 100, 2);
        $element = array("label" => "inv" . $i, "color" => $color, "y" => $x);
        array_push($obj, $element);
    }
}

header('Content-Type: application/json');

echo json_encode($obj);

$conn->close();
