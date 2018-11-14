<?php // include 'masterpage.php'; ?>
<!DOCTYPE HTML>
<?php
   	include 'process/process_basicSetup.php';
   	date_default_timezone_set('Asia/Singapore');
        $collection = $db->traffic_incident;

//    if (!$$collection) {
//            die ('Failed to connect to MongoDB');	
//    }
    $cursor = $collection->find(array(), array("region" => 1));
    //$sql = "SELECT region FROM Traffic_incident";
    //$result = mysqli_query($conn, $sql);
    //$numOfResult = mysqli_num_rows($result);
    $regionArray = ["North", "North East", "West", "East", "Central"];
    $numPerRegion = [0, 0, 0, 0, 0];
    $date = 0;
 
        foreach ($cursor as $doc){
//    	while($row=$doc){
    		for ($i = 0; $i < sizeof($regionArray); $i++){
    			if ($doc['region'] == $regionArray[$i]){
    				$numPerRegion[$i]++;
    				break;
    			}
    		}
    	}
//        }
    
     $cursor2 = $collection->find(array(), array("region" => 1,"message"=>1));
    //$sql2 = "SELECT region, message FROM Traffic_incident";
    //$result2 = mysqli_query($conn, $sql2);
    $past24HrArray = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    $past24HrTime = array();
    $currentHr = date("H");
    $startingDay = date("d");
    $startingHr =  $currentHr - 24;

    if ($startingHr < 0){
    	$startingDay -= 1;
    	$startingHr = 24 + $startingHr;
    }
        
   	if($cursor2 <> null){
	    foreach ($cursor2 as $doc2)
	    	for ($j = 0; $j < sizeof($past24HrArray); $j++){
	    		$currentHrIncrement = $startingHr + $j;
	    		if ($currentHrIncrement > 23){
	    			$currentHrIncrement -= 24;
	    		}
	    		if (sizeof($past24HrTime) < 24){		
	    			array_push($past24HrTime, $currentHrIncrement);
	    		}
	    		if ((int)substr($doc2['region'], 1, 2) >= $startingDay){
					if ((int)substr($row2['region'], 7, 2) == $currentHrIncrement){
		    			$past24HrArray[$j]++;
		    			break;
	    			}
	    		}
	    		$currentHrIncrement = $startingHr;
	    	}
	    }
    
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
		var hour1 = <?php echo $past24HrTime[0]; ?>;
		var hour2 = <?php echo $past24HrTime[1]; ?>;
		var hour3 = <?php echo $past24HrTime[2]; ?>;
		var hour4 = <?php echo $past24HrTime[3]; ?>;
		var hour5 = <?php echo $past24HrTime[4]; ?>;
		var hour6 = <?php echo $past24HrTime[5]; ?>;
		var hour7 = <?php echo $past24HrTime[6]; ?>;
		var hour8 = <?php echo $past24HrTime[7]; ?>;
		var hour9 = <?php echo $past24HrTime[8]; ?>;
		var hour10 = <?php echo $past24HrTime[9]; ?>;
		var hour11 = <?php echo $past24HrTime[10]; ?>;
		var hour12 = <?php echo $past24HrTime[11]; ?>;
		var hour13 = <?php echo $past24HrTime[12]; ?>;
		var hour14 = <?php echo $past24HrTime[13]; ?>;
		var hour15 = <?php echo $past24HrTime[14]; ?>;
		var hour16 = <?php echo $past24HrTime[15]; ?>;
		var hour17 = <?php echo $past24HrTime[16]; ?>;
		var hour18 = <?php echo $past24HrTime[17]; ?>;
		var hour19 = <?php echo $past24HrTime[18]; ?>;
		var hour20 = <?php echo $past24HrTime[19]; ?>;
		var hour21 = <?php echo $past24HrTime[20]; ?>;
		var hour22 = <?php echo $past24HrTime[21]; ?>;
		var hour23 = <?php echo $past24HrTime[22]; ?>;
		var hour24 = <?php echo $past24HrTime[23]; ?>;

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

		window.onload = function () {

		var chart1 = new CanvasJS.Chart("chartContainer1", {
			exportEnabled: true,
			animationEnabled: true,
			title:{
				text: "Number of accidents from each region"
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
			animationEnabled: true,
			zoomEnabled: true,
			theme: "dark2",
			title:{
				text: "Number of accidents for past 24 hours"
			},
			axisX:{
		title: "Past 24 hours",
		valueFormatString: "####",
		interval: 2
	},
	
		axisY:{
			title: "Number of accidents",
			titleFontColor: "#6D78AD",
			logarithmic: false, //change it to false
			lineColor: "#6D78AD",
			gridThickness: 0,
			lineThickness: 1,
			labelFormatter: addSymbols
	},
		legend:{
		verticalAlign: "top",
		fontSize: 16,
		dockInsidePlotArea: true
	},
		data: [{
		type: "line",
		xValueFormatString: "####",
		showInLegend: true,
		name: "Number of accidents",
				dataPoints: [
					{ x: hour1, y: pastHrCount1 },
					{ x: hour2, y: pastHrCount2 },
					{ x: hour3, y: pastHrCount3 },
					{ x: hour4, y: pastHrCount4 },
					{ x: hour5, y: pastHrCount5 },
					{ x: hour6, y: pastHrCount6 },
					{ x: hour7, y: pastHrCount7 },
					{ x: hour8, y: pastHrCount8 },
					{ x: hour9, y: pastHrCount9 },
					{ x: hour10, y: pastHrCount10 },
					{ x: hour11, y: pastHrCount11 },
					{ x: hour12, y: pastHrCount12 },
					{ x: hour13, y: pastHrCount13 },
					{ x: hour14, y: pastHrCount14 },
					{ x: hour15, y: pastHrCount15 },
					{ x: hour16, y: pastHrCount16 },
					{ x: hour17, y: pastHrCount17 },
					{ x: hour18, y: pastHrCount18 },
					{ x: hour19, y: pastHrCount19 },
					{ x: hour20, y: pastHrCount20 },
					{ x: hour21, y: pastHrCount21 },
					{ x: hour22, y: pastHrCount22 },
					{ x: hour23, y: pastHrCount23 }, 
					{ x: hour24, y: pastHrCount24 }
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
	<div id="chartContainer1" style="height: 370px; max-width: 920px; margin: 0px auto; margin-top: 100px;"></div>
	<div id="chartContainer2" style="height: 370px; max-width: 920px; margin: 0px auto; margin-top: 150px;"></div>
</body>
</html>