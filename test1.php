<?php
date_default_timezone_set("Asia/Bangkok");
$dt = date("Ymd");
$dt2 = date("d/m/Y");

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dynamic Line Chart with 4 Lines</title>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>

<body>

    <div id="chartContainer" style="height: 370px; width: 100%;"></div>

    <script>
        // ตรวจสอบค่า initialDateTime จาก PHP
        const initialDateTime = "<?php echo $dt . ' ' . $dt2; ?>";
        console.log("Initial DateTime:", initialDateTime); // ตรวจสอบค่าใน console

        var colorff6820 = '#ff6820';
        var color807bfa = '#807bfa';
        var color45ab71 = '#45ab71';
        var color040460 = '#040460';
        var colorbf4a04 = '#bf4a04';
        
        let lastUpdateTime = null; // ตัวแปรเก็บเวลาล่าสุดที่อัปเดตข้อมูล

        function updateChart() {
            fetch('test.php')
                .then(response => response.json())
                .then(data => {
                    const newLine1Data = [];
                    const newLine2Data = [];
                    const newLine3Data = [];
                    const newLine4Data = [];

                    data.forEach(item => {
                        const currentTime = new Date(item.date).getTime(); // แปลงเป็น timestamp
                        if (!lastUpdateTime || currentTime > lastUpdateTime) {
                            newLine1Data.push({
                                x: currentTime,
                                y: item.line1
                            });
                            newLine2Data.push({
                                x: currentTime,
                                y: item.line2
                            });
                            newLine3Data.push({
                                x: currentTime,
                                y: item.line3
                            });
                            newLine4Data.push({
                                x: currentTime,
                                y: item.line4
                            });

                            lastUpdateTime = currentTime; // อัปเดตเวลาล่าสุด
                        }
                    });

                    // Append ข้อมูลใหม่ไปยัง dataPoints
                    chart.options.data[0].dataPoints.push(...newLine1Data);
                    chart.options.data[1].dataPoints.push(...newLine2Data);
                    chart.options.data[2].dataPoints.push(...newLine3Data);
                    chart.options.data[3].dataPoints.push(...newLine4Data);

                    chart.render();
                })
                .catch(error => console.error('Error:', error));
        }

        function updateChartTitle() {
            const now = new Date();
            const formattedTime = now.toLocaleTimeString("th-TH", {
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit"
            });

            // อัปเดต title ของกราฟด้วยวันที่เริ่มต้น + เวลาไดนามิก
            chart.options.title.text = `${initialDateTime} ${formattedTime}`;
            console.log("Updated Title:", chart.options.title.text); // ตรวจสอบการอัปเดตใน console
            chart.render();
        }

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: initialDateTime, // เริ่มต้นด้วย datetime จาก PHP
                horizontalAlign: "left",
                maxWidth: 220,
                fontColor: "#bf4a04"
            },
            backgroundColor: "#f0f0f0",
            zoomEnabled: true,
            axisX: {
                valueFormatString: "HH:mm"
            },
            axisY: [{
                    title: "LoadTotal",
                    lineColor: "#ad364a"
                },
                {
                    title: "IRR"
                }
            ],
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                fontSize: 16,
                fontColor: "dimGrey"
            },
            data: [{
                    type: "line",
                    name: "Load Total",
                    xValueType: "dateTime",
                    xValueFormatString: "DD/MM/YYYY H:mm:ss",
                    color: colorff6820,
                    showInLegend: true,
                    dataPoints: []
                },
                {
                    type: "line",
                    name: "Solar",
                    xValueType: "dateTime",
                    xValueFormatString: "DD/MM/YYYY H:mm:ss",
                    color: color807bfa,
                    showInLegend: true,
                    dataPoints: []
                },
                {
                    type: "line",
                    name: "MEA",
                    xValueType: "dateTime",
                    xValueFormatString: "DD/MM/YYYY H:mm:ss",
                    color: color45ab71,
                    showInLegend: true,
                    dataPoints: []
                },
                {
                    type: "line",
                    name: "IRR",
                    axisYIndex: 1,
                    xValueType: "dateTime",
                    xValueFormatString: "DD/MM/YYYY H:mm:ss",
                    color: color040460,
                    showInLegend: true,
                    dataPoints: []
                }
            ]
        });
        chart.render();

        // เรียกใช้งานการอัปเดต title ทุก ๆ วินาที
        setInterval(updateChart, 1000);
        setInterval(updateChartTitle, 1000);

        updateChart();
        updateChartTitle();
    </script>

    

</body>

</html>

