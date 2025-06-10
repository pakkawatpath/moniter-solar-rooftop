<?php
include_once 'db.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="HandheldFriendly" content="true">
  <meta name="viewport" content="width=device-width, initial-scale=0.666667, maximum-scale=0.666667, user-scalable=0">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .flex-container {
      display: flex;
      flex-wrap: nowrap;

    }

    .flex-container>div {
      width: 100%;
      text-align: center;
    }

    body {
      background-color: white;
      overflow-x: hidden;
    }

    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #f8f9f9;
    }

    li {
      float: left;
    }

    li a,
    .dropbtn {
      display: inline-block;
      color: #676767;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    li a:hover,
    .dropdown:hover .dropbtn {
      background-color: #d4d0c8;
    }

    li.dropdown {
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    #title {
      color: #014f7b;
      font-size: 24px;
      padding-left: 10px;
      font-weight: bold;
    }

    #menu {
      float: right;
      font-size: 16px;
    }

    @media only screen and (max-width:800px) {

      /* For tablets: */
      #title {
        color: #014f7b;
        padding-left: 30px;
      }

    }

    @media only screen and (max-width:500px) {

      /* For mobile phones: */
      #title {
        color: #014f7b;
        padding-left: auto;
        padding-right: auto;
      }

      #menu {
        float: right;
      }
    }
  </style>
</head>

<body>
  <div class="flex-container">
    <div>
      <ul>
        <li>
          <p id="title">Solar monitoring system PSTC</p>
        </li>
        <!-- <li id="menu"><a href="profile?Page=1">Seting</a></li> -->
        <li id="menu"><a href="report?id=<?php echo $id ?>&location=<?php echo $location ?>">Report</a></li>
        <li id="menu"><a href="inverter?id=<?php echo $id ?>&location=<?php echo $location ?>">Inverter</a></li>
        <li id="menu"><a href="home?id=<?php echo $id ?>&location=<?php echo $location ?>">Main</a></li>
      </ul>
      <br>
      <!-- <form action="search" method="get">
      <input type="hidden" name="Page" value="1">
      <div class="container" style="text-align: center;">

        <label>รหัสพนักงาน</label>
        <input type="text" name="pid">
        &nbsp;
        <label>ชื่อพนักงาน</label>
        <input type="text" name="name">
        &nbsp;
        <label>ตั้งแต่วันที่</label>
        <input type="date" name="date1">
        <label>ถึงวันที่</label>
        <input type="date" name="date2">
        &nbsp;
        <select name="status">
          <option value="all">รายชื่อทั้งหมด</option>
          <option value="in">รายชื่อที่ยังอยู่</option>
          <option value="out">รายชื่อที่ลาออก</option>
        </select>

      </div>
      <br>
      <div style="text-align: center;">
        <input type="submit" name='su'>
      </div>
    </form> -->
    </div>

  </div>



</body>

</html>