<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $location_id = $_POST['location_id'];
    $query = "DELETE FROM location_site WHERE location_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $location_id);

    if ($stmt->execute()) {
        mysqli_query($conn, "DELETE FROM inverter WHERE location_id = '$location_id'");
        mysqli_query($conn, "DELETE FROM edmi WHERE location_id = '$location_id'");
        mysqli_query($conn, "DELETE FROM pqm WHERE location_id = '$location_id'");
        mysqli_query($conn, "DELETE FROM pv_current WHERE location_id = '$location_id'");
        mysqli_query($conn, "DELETE FROM pv_voltage WHERE location_id = '$location_id'");
        echo 'success';
    } else {
        echo 'error';
    }
}

if (isset($_GET['inverter_id'])) {
    $inverter_id = $_GET['inverter_id'];
    $location_id = $_GET['location_id'];
    mysqli_query($conn, "DELETE FROM `inverter` WHERE `inverter_id` = '$inverter_id'");
    echo '<script>';
    echo 'window.location.href="edit.php?location_id=' . $location_id . '"';
    echo '</script>';
}
