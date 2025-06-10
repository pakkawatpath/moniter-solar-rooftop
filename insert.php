<?php
include_once 'db.php';

if (isset($_POST['location'])) {
    $location_name = $_POST['locationname'];
    $production_capacity = $_POST['productioncapacity'];
    $location_code = $_POST['locationcode'];

    $query = "INSERT INTO location_site (location_code, location_name, production_capacity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $location_code, $location_name, $production_capacity);

    if ($stmt->execute()) {
        $check = mysqli_query($conn, "SELECT * FROM `location_site` WHERE `location_code` = '$location_code' AND `location_name` = '$location_name' AND `production_capacity` = '$production_capacity'");
        while ($result = $check->fetch_array()) {
            $location_id = $result['location_id'];
            mysqli_query($conn, "INSERT INTO `edmi`(`location_id`) VALUES ('$location_id')");
            mysqli_query($conn, "INSERT INTO `pqm`(`location_id`) VALUES ('$location_id')");
        }
        echo '<script>';
        echo 'window.location.href="pageinsert.php?locationname=' . urlencode($location_name) . '&productioncapacity=' . urlencode($production_capacity) . '";';
        echo '</script>';
    } else {
        echo 'error';
    }
}

if (isset($_POST['inverter'])) {

    $locationname = $_POST['locationname'];
    $productioncapacity = $_POST['productioncapacity'];
    $inverternumber = $_POST['inverternumber'];

    $row = mysqli_query($conn, "SELECT * FROM `location_site` WHERE `location_name` = '$locationname'");
    while ($result = $row->fetch_array()) {

        for ($i = 1; $i <= $inverternumber; $i++) {
            $id = $result['location_id'];
            $query = "INSERT INTO `inverter`(`number`,`location_id`) VALUES ('$i','$id')";
            mysqli_query($conn, $query);
            mysqli_query($conn, "INSERT INTO `pv_current`(`device_id`, `number`, `location_id`) VALUES ('$i', '$i','$id')");
            mysqli_query($conn, "INSERT INTO `pv_voltage`(`device_id`, `number`, `location_id`) VALUES ('$i', '$i','$id')");
        }

        echo '<script>';
        echo 'window.location.href="setting.php?location=all"';
        echo '</script>';
    }
}
