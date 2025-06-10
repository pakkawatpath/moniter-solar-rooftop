<?php
include_once 'db.php';

if (isset($_POST['upload'])) {
    $location_id = $_POST['location_id']; // รับค่า Location ID จากฟอร์ม
    $logo = file_get_contents($_FILES['logo']['tmp_name']); // อ่านไฟล์ในรูปแบบ Binary
    // ตรวจสอบว่ามีโลโก้เดิมในฐานข้อมูลหรือไม่
    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM location_site WHERE location_id = ?");
    $stmt_check->bind_param("i", $location_id);
    $stmt_check->execute();
    $stmt_check->bind_result($exists);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($exists > 0) {
        // ถ้ามีโลโก้เดิม ให้ทำการ UPDATE
        $stmt = $conn->prepare("UPDATE location_site SET logo = ? WHERE location_id = ?");
        $stmt->bind_param("si", $logo, $location_id); // b = blob, i = integer
    } 

    if ($stmt->execute()) {
        echo '<script>';
        echo 'window.location.href="setting.php?logocompany=all"';
        echo '</script>';
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ไม่พบข้อมูลในฟอร์ม";
}
?>
