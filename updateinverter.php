<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inverter_id = $_POST['inverter_id'];
    $device_id = $_POST['device_id'];
    $inverter_name = $_POST['inverter_name'];

    $sql = "UPDATE `inverter` SET `device_id` = '$device_id', `inverter_name` = '$inverter_name' WHERE `inverter_id` = '$inverter_id'";
    if (mysqli_query($conn, $sql)) {
        mysqli_query($conn, "UPDATE `pv_current` SET `device_id` = '$device_id' WHERE `device_id` = '$inverter_id'");
        mysqli_query($conn, "UPDATE `pv_voltage` SET `device_id` = '$device_id' WHERE `device_id` = '$inverter_id'");
        header("Location: edit.php?location_id=" . $_POST['location_id']);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
