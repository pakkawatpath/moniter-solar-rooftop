<?php
include_once 'db.php';
include_once 'menusetting.php';
?>

<!DOCTYPE html>
<html>

<head>
    <style>
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

        th,
        td {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        span {
            color: red;
        }

        .save-btn,
        .delete-btn {
            padding: 5px 10px;
            cursor: pointer;
            border: none;
            background: none;
        }

        input[type="text"] {
            width: 100%;
        }

        button img {
            width: 15px;
            /* กำหนดความกว้างรูปภาพ */
            height: 15px;
            /* กำหนดความสูงรูปภาพ */
        }
    </style>
    <script>
        function deleteRow(button) {
            const row = button.parentNode.parentNode;
            const locationId = row.dataset.id;

            if (confirm("คุณต้องการลบข้อมูลนี้หรือไม่?")) {
                // ส่งคำขอลบข้อมูลไปยังเซิร์ฟเวอร์
                fetch('delete.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `location_id=${locationId}`
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data === 'success') {
                            row.remove();
                        } else {
                            alert("ลบข้อมูลล้มเหลว");
                        }
                    });
            }
        }
    </script>
</head>

<body>
    <?php
    if (isset($_GET['location'])) {
    ?>
        <div class="container">
            <br>
            <div style="text-align: center;">
                <h3>เพิ่ม Location</h3>
                <form action="insert" method="post">
                    <label>Location_code<span>*</span></label>
                    <input type="text" style="width: 250px;" name="locationcode" autocomplete="off" required>
                    <label>Location Name<span>*</span></label>
                    <input type="text" style="width: 250px;" name="locationname" autocomplete="off" required><br><br>
                    <label>Production Capacity<span>*</span></label>
                    <input type="text" style="width: 250px;" name="productioncapacity" autocomplete="off" required><br><br>
                    <input type="submit" name="location" value="เพิ่ม">
                </form>
            </div>
            <br>
            <table width="80%" style="border-collapse: collapse; font-size:1em; border-spacing: 20px;">
                <thead>
                    <tr>
                        <th class="text-center" width="1%">ลบ</th>
                        <th class="text-center" width="1%">แก้ไข</th>
                        <th class="text-center" width="10%">Location Code</th>
                        <th class="text-center" width="10%">Location Name</th>
                        <th class="text-center" width="10%">Production Capacity</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $locationrow = mysqli_query($conn, "SELECT * FROM `location_site` ORDER BY `location_id`");
                    while ($locationresult = $locationrow->fetch_array()) {
                    ?>
                        <tr data-id="<?php echo $locationresult['location_id']; ?>">
                            <td class="text-center">
                                <button class="delete-btn" onclick="deleteRow(this)"><img src="./image/delete.gif"></button>
                            </td>
                            <td class="text-center">
                                <a href="edit.php?location_id=<?php echo $locationresult['location_id']; ?>"><img src="./image/edit.gif"></a>
                            </td>
                            <td class="editable"><?php echo $locationresult['location_code']; ?></td>
                            <td class="editable"><?php echo $locationresult['location_name']; ?></td>
                            <td class="editable"><?php echo $locationresult['production_capacity']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    } elseif (isset($_GET['logocompany'])) {
    ?>
        <div class="container">
            <br>
            <div style="text-align: center;">
                <h3>เพิ่ม Logo Company</h3>

            </div>
            <br>
            <table width="80%" style="border-collapse: collapse; font-size:1em; border-spacing: 20px;">
                <thead>
                    <tr>
                        <th class="text-center" width="1%">Upload</th>
                        <th class="text-center" width="10%">Location Name</th>
                        <th class="text-center" width="10%">Logo Company</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $locationrow = mysqli_query($conn, "SELECT * FROM `location_site` ORDER BY `location_id`");
                    while ($locationresult = $locationrow->fetch_array()) {
                    ?>
                        <tr data-id="<?php echo $locationresult['location_id']; ?>">
                            <td class="text-center">
                                <form action="upload.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="location_id" value="<?php echo $locationresult['location_id']; ?>">
                                    <input type="file" name="logo" accept="image/*" required>
                                    <input type="submit" name="upload" value="Upload">
                                </form>
                            </td>
                            <td><?php echo $locationresult['location_name']; ?></td>
                            <td>
                                <?php
                                if (!empty($locationresult['logo'])) {
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($locationresult['logo']) . '" style="max-width: 100px; max-height: 100px;">';
                                } else {
                                    echo '<span>ไม่มีโลโก้</span>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    }
    ?>

</body>

</html>