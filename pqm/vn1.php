<?php
error_reporting(0);

function vn1($inverter_id)
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = "moniter_solar_rooftop";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $row = mysqli_query($conn, "SELECT * FROM `pqm` WHERE `location_id` = '$inverter_id'");
    $result = $row->fetch_array();
    return $result['VN_1'];
}

$inverter = $_GET['inverter_id'];

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
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            
        }
    </style>
</head>

<body style="background-color: #f0f0f0;">
    <p id="square6"></p>
    <meta http-equiv="refresh" content="35">
    <script>
        var invx = <?php echo vn1($inverter)?>;
        document.getElementById("square6").innerHTML = invx;
    </script>
</body>

</html>