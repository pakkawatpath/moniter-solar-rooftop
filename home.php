<?php
// error_reporting(0);
$id = $_GET['id'];
$location = $_GET['location'];

include 'menu.php';

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
    <title>Chart</title>
    <style>
        iframe {
            text-align: center;
        }

        #texttop1 {
            color: #bd8307;
            font-size: 18px;
        }

        #texttop2 {
            color: #109310;
            font-size: 20px;
            font-weight: bold;
        }

        #colortable {
            background-color: #f0f0f0;
        }

        #square1 {
            height: 10px;
            width: 30px;
            background-color: #ff6820;
            display: inline-block;
        }

        #square2 {
            height: 10px;
            width: 30px;
            background-color: #807bfa;
            display: inline-block;
        }

        #square3 {
            height: 10px;
            width: 30px;
            background-color: #45ab71;
            display: inline-block;
        }

        #square4 {
            height: 10px;
            width: 30px;
            background-color: #040460;
            display: inline-block;
        }

        #square5 {
            height: 16px;
            width: 50px;
            line-height: 15px;
            background-color: #e6e6fa;
            display: inline-block;
            border-radius: 3px;
            color: #019601;
            text-align: center;
        }

        #square6 {
            height: 40px;
            width: 140px;
            line-height: 35px;
            font-size: 20px;
            background-image: linear-gradient(#b2f1ef, #ffffff);
            display: inline-block;
            border-radius: 10px;
            color: #53bc86;
            text-align: center;
            font-weight: bold;

        }

        #img {
            width: 200px;
            height: 100px;
        }

        #table1 {
            width: 80%;
            background-color: #d3d2d7;
        }

        #imgtop {
            width: 35px;
            height: 35px;
        }

        #chartContainer {
            width: 100%;
            height: 83%;
        }

        #space {
            margin-top: 8px;
        }

        #solaracc {
            width: 100%;
            background-color: #ffffff;
        }

        #textback {
            position: relative;
            text-align: center;
            color: white;
        }

        .text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 15px;
            font-weight: bold;
            color: #014d79;
        }

        @media only screen and (max-width:800px) {

            /* For tablets: */
            #space {
                margin-top: 40px;
            }

            #solaracc {
                width: 22%;
                margin-top: 10px;
                margin-left: auto;
                margin-right: auto;
                background-color: #ffffff;
            }
        }

        @media only screen and (max-width:500px) {

            /* For mobile phones: */
            #img {
                width: 150px;
                height: 150px;
            }

            #table1 {
                width: 90%;
                background-color: #d3d2d7;
            }

            #texttop1 {
                color: #bd8307;
                font-size: 15px;
            }

            #texttop2 {
                color: #109310;
                font-size: 16px;
                font-weight: bold;
            }

            #imgtop {
                width: 35px;
                height: 35px;
            }

            #chartContainer {
                width: 100%;
                height: 400%;
            }

            #space {
                margin-top: 340px;
            }

            #solaracc {
                width: 47%;
                background-color: #ffffff;
            }
        }
    </style>
</head>

<body style="background-color: #e6e6fa;font-size: 16px;">
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <?php
                

                $rowx = mysqli_query($conn, "SELECT * FROM `location_site` WHERE `location_id` = '$id'");
                $locationresult = $rowx->fetch_array();

                if (!empty($locationresult['logo'])) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($locationresult['logo']) . '" id="img">';
                } else {
                    echo '<span>ไม่มีโลโก้</span>';
                }
                ?>
            </div>
            <div class="col" id="textback">
                <img src="./image/map.jpg" id="img">
                <div class="text"><?php echo $locationresult['location_name'] . "<br>" . $locationresult['production_capacity'] . " kWp." ?></div>
            </div>
            <div class="col">
                <table id="table1">
                    <tr>
                        <th id="texttop1"><img src="./image/sun.png" id="imgtop">Irradiation</th>

                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top: 10px;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td id="texttop2"><iframe src="./data/irradiation.php?location_id=<?php echo $id ?>" height="23" width="60" scrolling="no"></iframe>W/m²</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top: 20px;"></div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table id="table1">
                    <tr>
                        <th id="texttop1"><img src="./image/tempmo.png" id="imgtop">Ambient</th>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top: 10px;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td id="texttop2"><iframe src="./data/ambient.php?location_id=<?php echo $id ?>" height="23" width="60" scrolling="no"></iframe>°C</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top: 20px;"></div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table id="table1">
                    <tr>
                        <th id="texttop1"><img src="./image/solarmo.png" id="imgtop">Module</th>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top: 10px;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td id="texttop2"><iframe src="./data/module.php?location_id=<?php echo $id ?>" height="23" width="60" scrolling="no"></iframe>°C</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top: 20px;"></div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table id="table1">
                    <tr>
                        <th id="texttop1"><img src="./image/wind.png" id="imgtop">Wind</th>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top: 10px;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td id="texttop2"><iframe src="./data/wind.php?location_id=<?php echo $id ?>" height="21" width="60" scrolling="no"></iframe>m/s</td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top: 20px;"></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="margin-top: 9px;"></div>
        <div class="row">
            <div class="col">
                <table style="width:100%;background-color: #ffffff;border-top-left-radius: 10px;border-top-right-radius: 10px;">
                    <tr>
                        <th colspan="4" style="text-align: left;background-color: #0080c0;color: #fbfdfd;border-top-left-radius: 10px;border-top-right-radius: 10px;">Power from Inverter</th>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top: 8px;"></div>
                        </td>
                    </tr>
                    <tr>
                        <!-- <td style="text-decoration: underline;color: #7ccba1;font-weight: bold;">Growatt inverter</td> -->
                        <td></td>
                        <td id="colortable" style="border-bottom: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1"></td>
                        <td id="colortable" style="border-bottom: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1;color: #0854bf;">Power (kW)</td>
                        <td id="colortable" style="border-bottom: 1px solid #e1e1e1;color: #0854bf;">Energy (kWh)</td>
                    </tr>
                    <tr>
                        <?php
                        $location_id = $locationresult['location_id'];
                        ?>
                        <td rowspan="7">
                            <img src="./image/inverter1.png" width="120" height="120">
                            <br>
                            <iframe src="./data/chart1.php?location_id=<?php echo $location_id ?>" height="200" width="60%" scrolling="no"></iframe>
                        </td>
                    </tr>
                    <?php                        
                    $chack = mysqli_query($conn, "SELECT * FROM `inverter` WHERE `location_id` = $location_id");
                    while ($row = mysqli_fetch_array($chack)) {
                    ?>
                        <tr id="colortable">
                            <td style="border-bottom: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1;color: #0854bf;"><?php echo "inv" . $row['number'] ?></td>
                            <td style="border-bottom: 1px solid #e1e1e1;border-right: 1px solid #e1e1e1;color: #53bc86;font-weight:bold;"><iframe src="./inv.php?location_id=<?php echo $location_id ?>&inv=<?php echo $row['inverter_id'] ?>" height="23" width="70" scrolling="no"></iframe></td>
                            <td style="border-bottom: 1px solid #e1e1e1;color: #53bc86;font-weight: bold;"><iframe src="./energy.php?inv=<?php echo $row['inverter_id'] ?>" height="23" width="70" scrolling="no"></iframe></td>
                        </tr>
                    <?php
                    }
                    ?>

                    <tr>
                        <td>
                            <div style="margin-top: 8px;"></div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table style="width: 100%;">
                    <tr>
                        <th style="text-align: left;background-color: #0080c0;color: #fbfdfd;border-top-left-radius: 10px;border-top-right-radius: 10px;">Chart of Power</th>
                    </tr>
                </table>
                <iframe src="./data/chart.php?location_id=<?php echo $location_id ?>" height="330" width="100%" scrolling="no"></iframe>
                <table style="width:100%;">
                    <tr>
                        <td colspan="6" style="background-color: #e6e6fa;"></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="background-color: #e6e6fa;"></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="background-color: #e6e6fa;"></td>
                    </tr>
                    <tr style="background-color: #0080c0;border-radius: 10px;">
                        <td>
                            <div class="square" id="square1"></div> Total
                        </td>
                        <td>
                            <div class="square" id="square2"></div> Solar
                        </td>
                        <td>
                            <div class="square" id="square3"></div> PEA
                        </td>
                        <td>
                            <div class="square" id="square4"></div> IRR
                        </td>
                        <td style="background-color: #e6e6fa;"></td>
                        <td>
                            <table>
                                <tr>
                                    <td style="color: white;">% Inverter (average)</td>
                                    <td>
                                        <div class="square" id="square5"><?php echo 100 ?></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="space"></div>
        <div class="row">
            <div class="col">
                <table style="width: 100%;background-color: #ffffff">
                    <tr style="background-color: #7d9ec0;">
                        <th style="color: white;">Power PEA</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="square" id="square6"><iframe src="./data/powerpea.php?location_id=<?php echo $location_id ?>" height="23" width="110" scrolling="no"></iframe></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #7c7dc6;font-weight: bold;">(kW)</td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table style="width: 100%;background-color: #ffffff">
                    <tr style="background-color: #7d9ec0;">
                        <th style="color: white;">Power Solar</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="square" id="square6"><iframe src="./data/powersolar.php?location_id=<?php echo $location_id ?>" height="23" width="110" scrolling="no"></iframe></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #7c7dc6;font-weight: bold;">(kW)</td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table style="width: 100%;background-color: #ffffff">
                    <tr style="background-color: #7d9ec0;">
                        <th style="color: white;">Power Total</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="square" id="square6"><iframe src="./data/powertotal.php?location_id=<?php echo $location_id ?>" height="23" width="110" scrolling="no"></iframe></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #7c7dc6;font-weight: bold;">(kW)</td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table style="width: 100%;background-color: #ffffff">
                    <tr style="background-color: #7d9ec0;">
                        <th style="color: white;">Solar Energy Today</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="square" id="square6"><iframe src="./data/solarenergytoday.php?location_id=<?php echo $location_id ?>" height="23" width="110" scrolling="no"></iframe></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #7c7dc6;font-weight: bold;">(kWh)</td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table id="solaracc">
                    <tr style="background-color: #7d9ec0;">
                        <th style="color: white;">Solar Accumulated</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="square" id="square6"><iframe src="./data/solaraccumulated.php?location_id=<?php echo $location_id ?>" height="23" width="120" scrolling="no"></iframe></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #7c7dc6;font-weight: bold;">(kWh)</td>
                    </tr>
                </table>
                <br>
            </div>
        </div>
    </div>

</body>

</html>