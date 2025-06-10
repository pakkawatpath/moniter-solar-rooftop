<?php
date_default_timezone_set("Asia/Bangkok");
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
        const initialDateTime = "<?php echo $dt2 ?>";
        console.log("Initial DateTime:", initialDateTime);

        var colors = {
            powerTotal: '#ff6820',
            solar: '#807bfa',
            pea: '#45ab71',
            irr: '#040460'
        };

        let lastUpdateTime = null;

        function updateChart() {
            fetch('datachart.php?location_id=<?php echo $_GET['location_id'] ?>')
                .then(response => response.json())
                .then(data => {
                    if (!data.length) return;

                    data.forEach(item => {
                        const currentTime = new Date(item.date).getTime();
                        if (!lastUpdateTime || currentTime > lastUpdateTime) {
                            chart.options.data[0].dataPoints.push({ x: currentTime, y: item.line1 });
                            chart.options.data[1].dataPoints.push({ x: currentTime, y: item.line2 });
                            chart.options.data[2].dataPoints.push({ x: currentTime, y: item.line3 });
                            chart.options.data[3].dataPoints.push({ x: currentTime, y: item.line4 });

                            lastUpdateTime = currentTime;
                        }
                    });

                    chart.render();
                })
                .catch(error => console.error('Error:', error));
        }

        function updateChartTitle() {
            const now = new Date();
            const formattedTime = now.toLocaleTimeString("th-TH", { hour: "2-digit", minute: "2-digit", second: "2-digit" });
            chart.options.title.text = `${initialDateTime} ${formattedTime}`;
            console.log("Updated Title:", chart.options.title.text);
            chart.render();
        }

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: initialDateTime,
                horizontalAlign: "left",
                fontColor: "#bf4a04"
            },
            backgroundColor: "#f0f0f0",
            zoomEnabled: true,
            axisX: { valueFormatString: "HH:mm" },
            axisY: [{ title: "LoadTotal", lineColor: "#ad364a" }, { title: "IRR" }],
            toolTip: { shared: true },
            legend: { cursor: "pointer", fontSize: 16, fontColor: "dimGrey" },
            data: [
                { type: "line", name: "Power Total", xValueType: "dateTime", xValueFormatString: "DD/MM/YYYY HH:mm:ss", color: colors.powerTotal, showInLegend: true, dataPoints: [] },
                { type: "line", name: "Solar", xValueType: "dateTime", xValueFormatString: "DD/MM/YYYY HH:mm:ss", color: colors.solar, showInLegend: true, dataPoints: [] },
                { type: "line", name: "PEA", xValueType: "dateTime", xValueFormatString: "DD/MM/YYYY HH:mm:ss", color: colors.pea, showInLegend: true, dataPoints: [] },
                { type: "line", name: "IRR", axisYIndex: 1, xValueType: "dateTime", xValueFormatString: "DD/MM/YYYY HH:mm:ss", color: colors.irr, showInLegend: true, dataPoints: [] }
            ]
        });

        chart.render();

        setInterval(updateChart, 1000);
        setInterval(updateChartTitle, 1000);

        updateChart();
        updateChartTitle();
    </script>

</body>

</html>
