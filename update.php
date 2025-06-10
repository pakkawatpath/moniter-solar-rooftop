<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location_id = $_POST['location_id'];
    $location_code = $_POST['location_code'];
    $location_name = $_POST['location_name'];
    $production_capacity = $_POST['production_capacity'];

    $query = "UPDATE location_site SET location_code = ?, location_name = ?, production_capacity = ? WHERE location_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdi", $location_code, $location_name, $production_capacity, $location_id);

    if ($stmt->execute()) {
        echo '<script>';
        echo 'window.location.href="edit.php?location_id=' . $location_id . '"';
        echo '</script>';
    } else {
        echo 'error';
    }
}
