<?php
	include 'masterpage.php';
	include 'process/process_basicSetup.php';
	include 'process/process_chart.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<script src="chartjs/canvasjs.min.js"></script>
	<script>
		// First chart variable
		var northCount = <?php echo $numPerRegion[0]; ?>;
		var northEastCount = <?php echo $numPerRegion[1]; ?>;
		var westCount = <?php echo $numPerRegion[2]; ?>;
		var eastCount = <?php echo $numPerRegion[3]; ?>;
		var centralCount = <?php echo $numPerRegion[4]; ?>;

		// Second chart variable
		var pastHrCount1 = <?php echo $past24HrArray[0]; ?>;
		var pastHrCount2 = <?php echo $past24HrArray[1]; ?>;
		var pastHrCount3 = <?php echo $past24HrArray[2]; ?>;
		var pastHrCount4 = <?php echo $past24HrArray[3]; ?>;
		var pastHrCount5 = <?php echo $past24HrArray[4]; ?>;
		var pastHrCount6 = <?php echo $past24HrArray[5]; ?>;
		var pastHrCount7 = <?php echo $past24HrArray[6]; ?>;
		var pastHrCount8 = <?php echo $past24HrArray[7]; ?>;
		var pastHrCount9 = <?php echo $past24HrArray[8]; ?>;
		var pastHrCount10 = <?php echo $past24HrArray[9]; ?>;
		var pastHrCount11 = <?php echo $past24HrArray[10]; ?>;
		var pastHrCount12 = <?php echo $past24HrArray[11]; ?>;
		var pastHrCount13 = <?php echo $past24HrArray[12]; ?>;
		var pastHrCount14 = <?php echo $past24HrArray[13]; ?>;
		var pastHrCount15 = <?php echo $past24HrArray[14]; ?>;
		var pastHrCount16 = <?php echo $past24HrArray[15]; ?>;
		var pastHrCount17 = <?php echo $past24HrArray[16]; ?>;
		var pastHrCount18 = <?php echo $past24HrArray[17]; ?>;
		var pastHrCount19 = <?php echo $past24HrArray[18]; ?>;
		var pastHrCount20 = <?php echo $past24HrArray[19]; ?>;
		var pastHrCount21 = <?php echo $past24HrArray[20]; ?>;
		var pastHrCount22 = <?php echo $past24HrArray[21]; ?>;
		var pastHrCount23 = <?php echo $past24HrArray[22]; ?>;
		var pastHrCount24 = <?php echo $past24HrArray[23]; ?>;

		var averageIncident = <?php echo $averageIncident; ?>;

		window.onload = function () {

		var chart1 = new CanvasJS.Chart("chartContainer1", {
			exportEnabled: true,
			animationEnabled: true,
			title:{
				text: "Number of incidents per region"
			},
			legend:{
				cursor: "pointer",
				itemclick: explodePie
			},
			data: [{
				type: "pie",
				showInLegend: true,
				toolTipContent: "{name}: <strong>{y} number of accidents</strong>",
				indexLabel: "{name} - {y}",
				dataPoints: [
					{ y: northCount, name: "North"},
					{ y: northEastCount, name: "North East" },
					{ y: westCount, name: "West" },
					{ y: eastCount, name: "East" },
					{ y: centralCount, name: "Central" },
				]
			}]
		});
		chart1.render();

		//Second chart
		var chart2 = new CanvasJS.Chart("chartContainer2", {
			theme: "dark2",
			animationEnabled: true,
			title:{
				text: "Number of incidents for past 24 hours"
			},
			axisX:{
				title: "Past 24 hours",
				valueFormatString: "####",
				interval: 1
			},
			axisY: {
				title: "Number of incidents",
				valueFormatString: "####",
				stripLines: [{
					value: averageIncident,
					label: "Average"
				}]
			},
			data: [{
				yValueFormatString: "####",
				xValueFormatString: "####",
				lineColor: "#6D78AD",
				type: "spline",
				dataPoints: [
					{ x: 1, y: pastHrCount1 },
					{ x: 2, y: pastHrCount2 },
					{ x: 3, y: pastHrCount3 },
					{ x: 4, y: pastHrCount4 },
					{ x: 5, y: pastHrCount5 },
					{ x: 6, y: pastHrCount6 },
					{ x: 7, y: pastHrCount7 },
					{ x: 8, y: pastHrCount8 },
					{ x: 9, y: pastHrCount9 },
					{ x: 10, y: pastHrCount10 },
					{ x: 11, y: pastHrCount11 },
					{ x: 12, y: pastHrCount12 },
					{ x: 13, y: pastHrCount13 },
					{ x: 14, y: pastHrCount14 },
					{ x: 15, y: pastHrCount15 },
					{ x: 16, y: pastHrCount16 },
					{ x: 17, y: pastHrCount17 },
					{ x: 18, y: pastHrCount18 },
					{ x: 19, y: pastHrCount19 },
					{ x: 20, y: pastHrCount20 },
					{ x: 21, y: pastHrCount21 },
					{ x: 22, y: pastHrCount22 },
					{ x: 23, y: pastHrCount23 },
					{ x: 24, y: pastHrCount24 }
				]
			}]
		});
		chart2.render();
		}

		function explodePie (e) {
			if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
				e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
			} else {
				e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
			}
			e.chart.render();
		}
		function addSymbols(e){
			var suffixes = ["", "K", "M", "B"];

			var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
			if(order > suffixes.length - 1)
				order = suffixes.length - 1;

			var suffix = suffixes[order];
			return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
		}
	</script>
</head>
<body>
	<div class="container-fluid bg-1">
			 <div class="row content">
					 <div class="col-sm-1 sidenav">

					 </div>
					 <div class="col-sm-10 mainscreen">

							 <div class="maincontent">

								 <header>
							     	<h1 style="auto; margin-top: 80px; text-align: center;">Incident statistics for the past 24 hours</h1>
							   	</header>
							 	<div id="chartContainer1" style="height: 370px; max-width: 920px; margin: 0px auto; margin-top: 50px;"></div>
							 	<div id="chartContainer2" style="height: 370px; max-width: 920px; margin: 0px auto; margin-top: 50px;"></div>
</div>
</div>
					</div>
						</div>
<div class="col-sm-1" sidenav>

</div>

</body>
</html>
