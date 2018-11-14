<?php include 'masterpage.php'; ?>
<!DOCTYPE HTML>
<?php
   	include 'process/process_basicSetup.php';
   	date_default_timezone_set('Asia/Singapore');
    if (!$conn) {
            die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
    }
    $sql = "SELECT region, message FROM Traffic_incident WHERE region <> 'None'";
    $result = mysqli_query($conn, $sql);
    $regionArray = ["North", "North East", "West", "East", "Central"];
    $numPerRegion = [0, 0, 0, 0, 0];
    $past24HrArray = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    $totalIncident = 0;
    $monthsWithPrevious31Days = [1, 2, 4, 6, 8, 9, 11];
    $monthsWithPrevious30Days = [5, 7, 10, 12];
    $currentMonth = date("m");
    $currentDate = date("d");
    $startingDay = date("d");
    $startingHr =  date("H") - 23;

    if ($startingHr < 0){
    	$startingDay -= 1;
    	$startingHr += 24;
    }
    if ($startingDay < 1){
    	if ($currentMonth == 3)
    		$startingDay = 28;
    	else{
    		for ($k = 0; $k < sizeof($monthsWithPrevious31Days); $k++){
	    		if ($currentMonth == $monthsWithPrevious31Days[$k]){
	    			$startingDay = 31;
	    			break;
	    		}
    			else
    				$startingDay = 30;
    		}
    	}	
    }
   	if($result){
	    while($row=mysqli_fetch_row($result)){
	    	if (((int)substr($row[1], 1, 2)) > 9){
	    		$monthStringStart = 4;
	    		$timeStringStart = 7;
	    	}
	    	else{
	    		$monthStringStart = 3;
	    		$timeStringStart = 6;
    		}
	    	if (((int)substr($row[1], $monthStringStart, 2)) > 9){
	    		$timeStringLength = 2;
	    	}
	    	else{
	    		$timeStringLength = 1;
	    		$timeStringStart -= 1;
	    	}
	    	for ($j = 0; $j < sizeof($past24HrArray); $j++){
	    		$currentHrIncrement = $startingHr + $j;
	    		if ($currentHrIncrement > 23)
	    			$currentHrIncrement -= 24;
	    		if ($startingDay == 28 && $currentMonth == 3)
	    			$currentDate = 1;
	    		else{
		    		for ($k = 0; $k < sizeof($monthsWithPrevious31Days); $k++){
		    			if ($startingDay == 31 && $currentMonth == $monthsWithPrevious31Days[$k]){
		    				$currentDate = 1;
		    				break;
	    				}
	    			}	
	    			for ($k = 0; $k < sizeof($monthsWithPrevious31Days); $k++){
	    				if ($startingDay == 30 && $currentMonth == $monthsWithPrevious30Days[$k]){
	    					$currentDate = 1;
		    				break;
		    			}
	    			}
	    		}
	    		if ($startingDay == 28 || $startingDay == 30 || $startingDay == 31){
	    			if ((int)substr($row[1], 1, 2) == $startingDay && (int)substr($row[1], $monthStringStart, $timeStringLength) == ($currentMonth - 1) && ((int)substr($row[1], $timeStringStart, $timeStringLength) >= $startingHr) && ((int)substr($row[1], $timeStringStart, $timeStringLength) == $currentHrIncrement)){
		    			$past24HrArray[$j]++;
			    		$totalIncident++;
			    		
			    		for ($i = 0; $i < sizeof($regionArray); $i++){
			    			if ($row[0] == $regionArray[$i]){
			    				$numPerRegion[$i]++;
			    				break;
			    			}
			    		}
		    		}
	    		}
	    		if ((int)substr($row[1], $monthStringStart, 2) == $currentMonth){
	    			if (((int)substr($row[1], 1, 2) == $currentDate) && ((int)substr($row[1], $timeStringStart, $timeStringLength) == $currentHrIncrement)){
	    				$past24HrArray[$j]++;
		    			$totalIncident++;
		    			for ($i = 0; $i < sizeof($regionArray); $i++){
			    			if ($row[0] == $regionArray[$i]){
			    				$numPerRegion[$i]++;
			    				break;
    						}
    					}
	    			}
	    			else if (((int)substr($row[1], 1, 2) == $startingDay) && ((int)substr($row[1], $timeStringStart, $timeStringLength) >= $startingHr) && ((int)substr($row[1], $timeStringStart, $timeStringLength) == $currentHrIncrement)){
						$past24HrArray[$j]++;
			    		$totalIncident++;
			    		for ($i = 0; $i < sizeof($regionArray); $i++){
			    			if ($row[0] == $regionArray[$i]){
			    				$numPerRegion[$i]++;
			    				break;
			    			}
			    		}
			    	}
	    		}
	    	}
	    }
    }
    $averageIncident = $totalIncident/24;
?>
<html>
<head>
	<meta charset="UTF-8">
	<script src="chartjs/canvasjs.min.js"></script>
	<script>
		// First chart variable
		var northCount = <?php echo  $numPerRegion[0]; ?>;
		var northEastCount = <?php echo  $numPerRegion[1]; ?>;
		var westCount = <?php echo  $numPerRegion[2]; ?>;
		var eastCount = <?php echo  $numPerRegion[3]; ?>;
		var centralCount = <?php echo  $numPerRegion[4]; ?>;

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
				toolTipContent: "{name}: <strong>{y} number of incidents</strong>",
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
	</script>
</head>
<body>
	<header>
    	<h1 style="auto; margin-top: 80px; text-align: center;">Incident statistics for the past 24 hours</h1>
  	</header>
	<div id="chartContainer1" style="height: 370px; max-width: 920px; margin: 0px auto; margin-top: 50px;"></div>
	<div id="chartContainer2" style="height: 370px; max-width: 920px; margin: 0px auto; margin-top: 50px;"></div>
</body>
</html>