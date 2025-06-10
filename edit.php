<?php
include_once 'db.php';
$location_id = $_GET['location_id'];

$row = mysqli_query($conn, "SELECT * FROM `location_site` WHERE `location_id` = '$location_id'");

?>

<!DOCTYPE html>
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
        a:link,
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
        }

        span {
            color: red;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        table,
        th,
        td {
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="margin-top: 10px;">
            <a href="setting.php?location=all">BACK</a>
        </div>
        <div style="text-align: center;">
            <h3>แก้ไข Location และ Inverter</h3>
            <br>
            <?php
            while ($result = $row->fetch_array()) {
            ?>
                    <input type="hidden" name="location_id" value="<?php echo $result['location_id']; ?>">
                    <label>Location Code<span>*</span></label>
                    <input type="text" style="width: 250px;" name="location_code" value="<?php echo $result['location_code']; ?>" autocomplete="off" required readonly>
                    <label>Location Name<span>*</span></label>
                    <input type="text" style="width: 250px;" name="location_name" value="<?php echo $result['location_name']; ?>" autocomplete="off" required readonly><br><br>
                    <label>Production Capacity<span>*</span></label>
                    <input type="text" style="width: 250px;" name="production_capacity" value="<?php echo $result['production_capacity']; ?>" autocomplete="off" required readonly><br><br>   
            <?php
            }
            ?>
            <br>
            <br>
            <form action="insertinv.php" method="post">
                <input type="hidden" name="location_id" value="<?php echo $location_id; ?>">
                <input type="submit" style="float: left;" value="เพิ่ม Inverter">
            </form>
            <br>
            <br>

            <table width="100%">
                <tr>
                    <th class="text-center" style="width: 10%;">ลบ</th>
                    <th class="text-center" style="width: 10%;">แก้ไข</th>
                    <th class="text-center">Device ID</th>
                    <th class="text-center">Inverter Name</th>
                </tr>
                <?php
                $rowinv = mysqli_query($conn, "SELECT * FROM `inverter` WHERE `location_id` = '$location_id'");
                while ($resultinv = $rowinv->fetch_array()) {
                ?>
                    <tr>
                        <td>
                            <form action="delete.php" method="get">
                                <input type="hidden" name="location_id" value="<?php echo $location_id; ?>">
                                <input type="hidden" name="inverter_id" value="<?php echo $resultinv['inverter_id']; ?>">
                                <input type="image" src="./image/delete.gif" alt="Submit" name="submit">
                            </form>
                        </td>
                        <td>
                            <form action="editinverter.php" method="post">
                                <input type="hidden" name="inverter_id" value="<?php echo $resultinv['inverter_id']; ?>">
                                <input type="hidden" name="location_id" value="<?php echo $location_id; ?>">
                                <input type="hidden" name="device_id" value="<?php echo $resultinv['device_id']; ?>">
                                <input type="hidden" name="inverter_name" value="<?php echo $resultinv['inverter_name']; ?>">
                                <input type="image" src="./image/edit.gif" alt="Submit">
                            </form>
                        </td>
                        <td><?php echo $resultinv['device_id']; ?></td>
                        <td><?php echo $resultinv['inverter_name']; ?></td>

                    </tr>
                <?php
                }
                ?>
            </table>

        </div>
    </div>
</body>

</html>