<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inverter_id = $_POST['inverter_id'];
    $location_id = $_POST['location_id'];
    $device_id = $_POST['device_id'];
    $inverter_name = $_POST['inverter_name'];
}
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
    </style>
    <title>แก้ไข Inverter</title>
</head>

<body>
    <div class="container">
        <div style="margin-top: 10px;">
            <a href="edit.php?location_id=<?php echo $location_id; ?>">BACK</a>
        </div>
        <div style="text-align: center;">
            <form action="updateinverter.php" method="post">
                <input type="hidden" name="inverter_id" value="<?php echo $inverter_id; ?>">
                <input type="hidden" name="location_id" value="<?php echo $location_id; ?>">
                <label>Device ID:</label>
                <input type="text" name="device_id" value="<?php echo $device_id; ?>" required>
                <label>Inverter Name:</label>
                <input type="text" name="inverter_name" value="<?php echo $inverter_name; ?>" required>
                <input type="submit" value="ยืนยัน">
            </form>
        </div>
    </div>


</body>

</html>