<?php
include_once 'db.php';
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <style>
        span {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="text-align: center;">
            <h3>เพิ่ม Inverter</h3>
            <br>
            <form action="insert.php" method="post">
                <label>Location Name<span>*</span></label>
                <input type="text" value="<?php echo $_GET['locationname']; ?>" disabled>
                <input type="hidden" name="locationname" value="<?php echo $_GET['locationname']; ?>">
                <label>Production Capacity<span>*</span></label>
                <input type="text" value="<?php echo $_GET['productioncapacity']; ?>" disabled>
                <input type="hidden" name="productioncapacity" value="<?php echo $_GET['productioncapacity']; ?>">
                <br>
                <br>
                <label>จำนวน Inverter<span>*</span></label>
                <input type="number" name="inverternumber" required>
                <br>
                <br>
                <input type="submit" name="inverter" value="ตกลง">
            </form>
        </div>
    </div>

</body>

</html>