<?php

include_once 'dbtest.php';
date_default_timezone_set("Asia/Bangkok");

$loadtotal = mt_rand(10, 20);
$pmq = mt_rand(10, 20);
$kwinvertor = mt_rand(10, 20);
$irr = mt_rand(10, 20);
$datetime = date("Y-m-d H:i:sa");
$datetimeunix = time();

mysqli_query($conn, "INSERT INTO `test`(`loadtotal`, `pmq`, `kwinvertor`, `irr`, `datetime`, `unix`) VALUES ('$loadtotal','$pmq','$kwinvertor', '$irr','$datetime','$datetimeunix')");

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="refresh" content="5">
</head>

</html>