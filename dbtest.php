<?php
error_reporting(0);
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "solar";
$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($conn, "set names utf8");
if ($conn->connect_errno) {
  die('Could not Connect MySql Server:' . $conn->connect_error);
}
