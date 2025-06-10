<?php
error_reporting(0);
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "moniter_solar_rooftop";
$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($conn, "set names utf8");
if ($conn->connect_errno) {
  die('Could not Connect MySql Server:' . $conn->connect_error);
}

session_start();
if (isset($_SESSION["UserID"])) {
  echo "<script>";
  echo "window.location='index.php'";
  echo "</script>";
}