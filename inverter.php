<?php
error_reporting(0);

$id = $_GET['id'];
$location = $_GET['location'];

include_once 'menu.php';

include_once 'db.php';

date_default_timezone_set("Asia/Bangkok");

$datetime = date("Y-m-d") . '%';

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
        #t1 {
            width: 100%;
            background-image: linear-gradient(#fefefe, #ecebfb);
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;

        }

        #t2 {
            width: 100%;
            background-image: linear-gradient(#fefefe, #ecebfb);
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        #t3 {
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

        #head2 {
            background-image: linear-gradient(to right, #34C83C, #3BB56C);
        }

        #w1 {
            width: 40%;
        }

        #colorf0f0f0 {
            background-color: #f0f0f0;
            border: 1px solid #e2e2e2;
        }

        @media only screen and (max-width:500px) {
            #t1 {
                width: 100%;
                background-image: linear-gradient(#fefefe, #ecebfb);
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                margin-top: 10px;
            }

            #t2 {
                width: 100%;
                background-image: linear-gradient(#fefefe, #ecebfb);
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                margin-top: 10px;
            }

            #t3 {
                width: 100%;
                background-image: linear-gradient(#fefefe, #ecebfb);
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                margin-top: 10px;
                margin-left: 166px;
            }
        }
    </style>
</head>

<body style="background-color: #c0ffff;text-align: center">

    <div class="row">
        <div class="col-sm-2">
            <table id="t1">
                <tr>
                    <th colspan="3" id="head1">PQM</th>
                </tr>

                <?php
                // ดึงข้อมูลแค่ครั้งเดียว
                $raw = mysqli_query($conn, "SELECT * FROM `pqm` WHERE `location_id` = '$id'");
                $rows = [];

                while ($row = $raw->fetch_array()) {
                    $rows[] = $row;
                }

                // รายการตัวแปร VN, VL, S, P ที่ต้องใช้
                $items = [
                    "VN_1" => "vn1.php",
                    "VN_2" => "vn2.php",
                    "VN_3" => "vn3.php",
                    "VL_1" => "vl1.php",
                    "VL_2" => "vl2.php",
                    "VL_3" => "vl3.php",
                    "S1"   => "s1.php",
                    "S2"   => "s2.php",
                    "S3"   => "s3.php",
                    "P1"   => "p1.php",
                    "P2"   => "p2.php",
                    "P3"   => "p3.php",
                    "Psum" => "psum.php"
                ];

                foreach ($items as $label => $file) {
                    echo "<tr><td>$label</td>";

                    foreach ($rows as $row) {
                        echo "<td id='colorf0f0f0'>
                    <iframe src='./pqm/$file?inverter_id={$row['location_id']}' height='23' width='110' scrolling='no'></iframe>
                  </td>";
                    }

                    echo "</tr>";
                }
                ?>

                <tr>
                    <td style="padding-top: 5px;"></td>
                </tr>
            </table>

        </div>
        <div class="col-sm-2">

            <?php
            $location_id = $row['location_id']; // ดึงค่าเพียงครั้งเดียว

            $fields = [
                'PF' => 'pf',
                'VL1' => 'vl1',
                'VL2' => 'vl2',
                'VL3' => 'vl3',
                'Amp1' => 'amp1',
                'Amp2' => 'amp2',
                'Amp3' => 'amp3',
                'TOU' => 'tou',
                'Peak Day' => 'peakday',
                'TOUD0' => 'toud0',
                'TOUD1' => 'toud1'
            ];
            ?>

            <table id="t2">
                <tr>
                    <th colspan="3" id="head1">EDMI</th>
                </tr>
                <tr>
                    <td style="padding-top: 7px;"></td>
                </tr>

                <?php foreach ($fields as $label => $file): ?>
                    <tr>
                        <td><?php echo $label; ?></td>
                        <td id="colorf0f0f0">
                            <iframe src="./edmi/<?php echo $file; ?>.php?inverter_id=<?php echo $location_id; ?>" height="23" width="110" scrolling="no"></iframe>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <tr>
                    <td style="padding-top: 7px;"></td>
                </tr>
            </table>


        </div>
        <div class="col-sm-6">

            <?php
            $raw = mysqli_query($conn, "SELECT * FROM `inverter` WHERE `location_id` = '$id'");
            $inverters = [];
            while ($row = $raw->fetch_array()) {
                $inverters[] = $row;
            }
            ?>

            <table id="t1">
                <tr id="head2">
                    <th style="border-top-left-radius: 10px;"></th>
                    <?php foreach ($inverters as $row) { ?>
                        <th><?php echo $row['inverter_name']; ?></th>
                    <?php } ?>
                    <th style="border-top-right-radius: 10px;padding-right: 5px;"></th>
                </tr>

                <tr>
                    <td style="padding-top: 3px;"></td>
                </tr>

                <?php
                $fields = [
                    'Status' => 'status',
                    'Psum' => 'psum',
                    'Fac' => 'fac',
                    'Vac1' => 'vac1',
                    'Vac2' => 'vac2',
                    'Vac3' => 'vac3',
                    'lac1' => 'lac1',
                    'lac2' => 'lac2',
                    'lac3' => 'lac3',
                    'Etoday' => 'etoday',
                    'Temp' => 'temp'
                ];

                foreach ($fields as $label => $file) {
                    echo "<tr><td>$label</td>";
                    foreach ($inverters as $row) {
                        echo "<td id='colorf0f0f0'><iframe src='./inv/$file.php?inverter_id={$row['inverter_id']}' height='23' width='110' scrolling='no'></iframe></td>";
                    }
                    echo "</tr>";
                }
                ?>

                <tr>
                    <td style="padding-top: 6px;"></td>
                </tr>
                <tr>
                    <td></td>
                    <?php
                    $raw = mysqli_query($conn, "SELECT * FROM `inverter` WHERE `location_id` = '$id'");
                    while ($row = $raw->fetch_array()) {
                    ?>
                        <td><a href="pv_voltage.php?location=<?php echo $location ?>&location_id=<?php echo $row['location_id'] ?>&number=<?php echo $row['number'] ?>&device_id=<?php echo $row['device_id'] ?>" target="_blank" style="text-decoration: none;">PV Voltage</a></td>
                    <?php
                    }
                    ?>

                </tr>
                <tr>
                    <td></td>
                    <?php
                    $raw = mysqli_query($conn, "SELECT * FROM `inverter` WHERE `location_id` = '$id'");
                    while ($row = $raw->fetch_array()) {
                        $inverters[] = $row;
                    ?>
                        <td><a href="pv_current.php?location=<?php echo $location ?>&location_id=<?php echo $row['location_id'] ?>&number=<?php echo $row['number'] ?>&device_id=<?php echo $row['device_id'] ?>" target="_blank" style="text-decoration: none;">PV Current</a></td>
                    <?php
                    }
                    ?>

                </tr>
                <tr>
                    <td style="padding-top: 6px;"></td>
                </tr>
            </table>

        </div>

    </div>

</body>

</html>