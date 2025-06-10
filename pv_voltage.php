<?php
error_reporting(0);

$number = $_GET['number'];
$location_id = $_GET['location_id'];
$location = $_GET['location'];
$device_id = $_GET['device_id'];

include_once 'db.php';

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* a:link,
        a:visited {
            background-color: #f44336;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        a:hover,
        a:active {
            background-color: red;
        } */

        #t2 {
            width: 100%;
            background-image: linear-gradient(#fefefe, #ecebfb);
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        #head1 {
            background-image: linear-gradient(to right, #34C83C, #3BB56C);
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        #colorf0f0f0 {
            background-color: #f0f0f0;
            border: 1px solid #e2e2e2;
        }

        @media only screen and (max-width:500px) {
            #t2 {
                width: 100%;
                background-image: linear-gradient(#fefefe, #ecebfb);
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body style="background-color: #c0ffff">
    <!-- <div style="margin-top: 10px;margin-left: 10px;">
        <a href="inverter.php?id=<?php echo $location_id ?>&location=<?php echo $location ?>">BACK</a>
    </div> -->
    <div class="container text-center">
        <div class="row">
            <div class="col"></div>
            <div class="col" style="margin-top: 70px;">

                <?php

                $fields = [
                    'PV1' => 'pvv1',
                    'PV2' => 'pvv2',
                    'PV3' => 'pvv3',
                    'PV4' => 'pvv4',
                    'PV5' => 'pvv5',
                    'PV6' => 'pvv6',
                    'PV7' => 'pvv7',
                    'PV8' => 'pvv8'
                ];
                ?>

                <table id="t2">
                    <tr>
                        <th colspan="3" id="head1">PV Voltage</th>
                    </tr>
                    <tr>
                        <td style="padding-top: 7px;"></td>
                    </tr>
                    <tr>
                        <td>Device ID</td>
                        <td id="colorf0f0f0"><?php echo $device_id; ?></td>
                    </tr>
                    <?php foreach ($fields as $label => $file): ?>
                        <tr>
                            <td><?php echo $label; ?></td>
                            <td id="colorf0f0f0">
                                <iframe src="./pv_voltage_data/<?php echo $file; ?>.php?location_id=<?php echo $location_id; ?>&device_id=<?php echo $device_id; ?>" height="23" width="110" scrolling="no"></iframe>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <tr>
                        <td style="padding-top: 7px;"></td>
                    </tr>
                </table>

            </div>
            <div class="col"></div>
        </div>

    </div>

</body>

</html>