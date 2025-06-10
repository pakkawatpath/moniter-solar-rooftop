<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>

<body>

    <div id="chartContainer" style="height: 170px; width: 100%;"></div>
    <iframe src="./data/datachart1.php?location_id=<?php echo $_GET['location_id']; ?>"style="display: none;"></iframe>
    <?php
    ?>
    <script>

        function updateChart() {
            // ดึงข้อมูลจาก PHP ผ่าน fetch
            fetch(`datachart1.php?location_id=<?php echo $_GET['location_id']; ?>`)
                .then(response => response.json())
                .then(data => {
                    // แปลงตัวเลขใน dataPoints ให้อยู่ในรูปแบบ K และสองตำแหน่งทศนิยม
                    data = data.map(point => ({
                        ...point,
                        y: (point.y/1) // หารพันและแสดงสองตำแหน่งทศนิยม
                    }));
                    
                    // อัปเดตข้อมูลในกราฟ
                    chart.options.data[0].dataPoints = data;
                    chart.render();
                })
                .catch(error => console.error('Error:', error));
        }

        // สร้างกราฟครั้งแรก
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            data: [{
                backgroundColor: "#ffffff",
                type: "doughnut",
                startAngle: 100,
                innerRadius: "60%",
                indexLabelPlacement: "inside",
                indexLabel: "{label}: #percent%", // แสดง K หลังจากหารพันและปัดสองตำแหน่งทศนิยม
                toolTipContent: "<b>{label}:</b> {y} (#percent%)", // แสดง K ใน Tooltip ด้วย
                dataPoints: [] // เริ่มต้นด้วย array ว่าง
            }]
        });
        chart.render();

        // เรียกใช้ฟังก์ชัน updateChart ทุก ๆ 1 วินาที
        setInterval(updateChart, 1000);

        // เรียกครั้งแรกเพื่อดึงข้อมูลทันทีที่โหลดหน้าเว็บ
        updateChart();
    </script>

</body>

</html>