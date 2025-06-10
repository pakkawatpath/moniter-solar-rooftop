<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      font-family: "Lato", sans-serif;
    }

    /* Fixed sidenav, full height */
    .sidenav {
      height: 100%;
      width: 200px;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #3d69b2;
      overflow-x: hidden;
      padding-top: 20px;
    }

    /* Style the sidenav links and the dropdown button */
    .sidenav a {
      padding: 6px 8px 6px 16px;
      text-decoration: none;
      font-size: 20px;
      color: #111;
      display: block;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
      outline: none;
    }

    /* On mouse-over */
    .sidenav a:hover {
      color: #f1f1f1;
    }



    /* Add an active class to the active dropdown button */
    .active {
      background-color: green;
      color: white;
    }



    /* Optional: Style the caret down icon */
    .fa-caret-down {
      float: right;
      padding-right: 8px;
    }

    /* Some media queries for responsiveness */
    @media screen and (max-height: 450px) {
      .sidenav {
        padding-top: 15px;
      }

      .sidenav a {
        font-size: 18px;
      }
    }
  </style>
</head>

<body>

  <div class="sidenav">
    <?php
    include_once 'db.php';
    $row = mysqli_query($conn, "SELECT * FROM `location_site`");
    while ($result = $row->fetch_array()) {
    ?>
      <a href="home?id=<?php echo $result['location_id']; ?>&location=<?php echo $result['location_name']; ?>" target="_blank"><?php echo $result['location_name']; ?></a>
    <?php
    }
    ?>
    <a href="setting" target="_blank">Setting</a>
  </div>

</body>

</html>