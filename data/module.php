<?php
error_reporting(0);

include_once($_SERVER['DOCUMENT_ROOT'] . "/moniter_solar_rooftop/db.php");
$location_id = $_GET['location_id'];
$sql = 'SELECT * FROM `location_site` WHERE `location_id` = "' . $location_id . '"';
$result = mysqli_query($conn, $sql);
$row = $result->fetch_array();
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
        #texttop2 {
            color: #109310;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body style="background-color: #d3d2d7;">
    <p id="texttop2"><?php echo $row['module'] ?></p>
    <meta http-equiv="refresh" content="35">
</body>

</html>