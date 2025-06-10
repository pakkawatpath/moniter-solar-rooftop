<?php
error_reporting(0);

$id = $_GET['id'];
$location = $_GET['location'];

include_once 'menu.php';

include_once 'db.php';

date_default_timezone_set("Asia/Bangkok");

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
        th,
        td {
            border: 1px solid #3e424a;
            text-align: center;
        }

        th {
            text-align: center;
            background-color: #c0d0e0;
        }

        #color2e2af4 {
            color: #2e2af4;
        }

        #color209e2d {
            color: #209e2d;
        }
    </style>
</head>

<body style="background-color: #e5e5fb;">
    

    <div class="container text-center">
        <div class="row">
            <div class="col">
                <form action="download.php" method="get">
                    <label>เลือกตั้งแต่วันที่ </label>
                    <input type="date" name="date1" required>
                    <label>ถึงวันที่ </label>
                    <input type="date" name="date2" required>
                    <br>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" style="margin-top: 5px;" value="Export to Excel">
                </form>
            </div>
        </div>
    </div>
    <div style="margin-top: 10px;"></div>

    <table width="100%" border="1">
        <tr>
            <th id="color2e2af4">DateTime</th>
            <th id="color209e2d">Load total</th>
            <th id="color209e2d">Sum inverter</th>
            <th id="color209e2d">Sum PQM</th>
            <th>IRR</th>
            <th>Ambtemp</th>
            <th>ModuleTemp</th>
            <th>Wind</th>
            <th>PowerINVsum</th>
            <th>TOU</th>
            <th>Peak Day</th>
            <?php
            $raw = mysqli_query($conn, "SELECT count(*) as COUNT FROM `inverter` WHERE `location_id` = '$id'");
            while ($row = $raw->fetch_array()) {
                for ($i = 1; $i <= $row['COUNT']; $i++) {
            ?>
                    <th>Eng_INV<?php echo $i ?></th>
            <?php
                }
            }
            ?>
        </tr>
        <?php
        $rawx = mysqli_query($conn, "SELECT STRAIGHT_JOIN lsl.datetime, lsl.power_manufacture, SUM(invl.active_power) AS suminv, lsl.irradiation, 
                                    lsl.ambient_temp, lsl.module, lsl.wind_speed, SUM(invl.Etoday) AS sumenergy, el.TOU
                                    FROM location_site_log AS lsl
                                    INNER JOIN inverter_log AS invl ON lsl.datetime = invl.datetime
                                    INNER JOIN edmi_log AS el ON lsl.datetime = el.datetime
                                    WHERE lsl.location_id = '$id' and invl.location_id = '$id' and el.location_id = '$id'
                                    GROUP BY lsl.datetime, lsl.power_manufacture, lsl.irradiation, lsl.ambient_temp, lsl.module, lsl.wind_speed, el.TOU
                                    ORDER BY lsl.datetime DESC LIMIT 39;");
        while ($rowx = $rawx->fetch_array()) {
        ?>
            <tr>

                <td id="color2e2af4"><?php echo $rowx['datetime'] ?></td>
                <td id="color209e2d"><?php echo $rowx['power_manufacture'] + $rowx['suminv'] ?></td>
                <td id="color209e2d"><?php echo $rowx['suminv'] ?></td>
                <td id="color209e2d"><?php echo $rowx['power_manufacture'] ?></td>
                <td><?php echo $rowx['irradiation'] ?></td>
                <td><?php echo $rowx['ambient_temp'] ?></td>
                <td><?php echo $rowx['module'] ?></td>
                <td><?php echo $rowx['wind_speed'] ?></td>
                <td><?php echo $rowx['sumenergy'] ?></td>
                <td><?php echo $rowx['TOU'] ?></td>
                <td><?php echo $rowx['TOU'] ?></td>
                <?php
                $datetime = $rowx['datetime'];
                $rawy = mysqli_query($conn, "SELECT DISTINCT Etoday FROM `inverter_log` WHERE `datetime` = '$datetime' AND  `location_id` = '$id'");
                while ($rowy = $rawy->fetch_array()) {
                ?>
                    <td><?php echo $rowy['Etoday'] ?></td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </table>

</body>

</html>