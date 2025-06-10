<?php

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Round;

error_reporting(0);
$location_id = $_GET['location_id'];
include_once ($_SERVER['DOCUMENT_ROOT'] . "/moniter_solar_rooftop/db.php");

$row = mysqli_query($conn, "SELECT power_manufacture FROM `location_site` WHERE `location_id` = '$location_id'");
$result = $row->fetch_array();



$rowsum = mysqli_query($conn, "SELECT SUM(`active_power`) as suminv FROM `inverter` WHERE `location_id` = '$location_id'");
$resultsum = $rowsum->fetch_array();

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=0.666667, maximum-scale=0.666667, user-scalable=0">
    <meta name="viewport" content="width=device-width">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        #square6 {
            font-size: 20px;
            border-radius: 10px;
            color: #53bc86;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body style="background: linear-gradient(#b2f1ef, #ffffff);">
    <div id="square6"><?php echo Round($result['power_manufacture'] + $resultsum['suminv'], 2); ?></div>
    <meta http-equiv="refresh" content="2">
</body>

</html>