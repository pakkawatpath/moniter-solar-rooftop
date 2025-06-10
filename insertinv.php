<?php
include_once 'db.php';
$location_id = $_POST['location_id'];

$check = mysqli_query($conn, "SELECT * FROM `inverter` WHERE `location_id` = '$location_id' order by `number` DESC");
$resultcheck = $check->fetch_array();
$number = $resultcheck['number'] + 1;


mysqli_query($conn, "INSERT INTO `inverter`(`number`, `location_id`) VALUES ('$number','$location_id')");

echo '<script>';
echo 'window.location.href="edit.php?location_id=' . $location_id . '"';
echo '</script>';
