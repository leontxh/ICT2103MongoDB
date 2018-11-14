<?php
   	
   	date_default_timezone_set('Asia/Singapore');
    $collection = $db->traffic_incident;
    $cursor = $collection->find(array(), array("region" => 1,"message"=>1));
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
    foreach($cursor as $row){
    	if (((int)substr($row['Message'], 1, 2)) > 9){
    		$monthStringStart = 4;
    		$timeStringStart = 7;
    	}
    	else{
    		$monthStringStart = 3;
    		$timeStringStart = 6;
		}
    	if (((int)substr($row['Message'], $monthStringStart, 2)) > 9){
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
    			if ((int)substr($row['Message'], 1, 2) == $startingDay && (int)substr($row['Message'], $monthStringStart, $timeStringLength) == ($currentMonth - 1) && ((int)substr($row['Message'], $timeStringStart, $timeStringLength) >= $startingHr) && ((int)substr($row['Message'], $timeStringStart, $timeStringLength) == $currentHrIncrement)){
	    			$past24HrArray[$j]++;
		    		$totalIncident++;
		    		
		    		for ($i = 0; $i < sizeof($regionArray); $i++){
		    			if ($row['region'] == $regionArray[$i]){
		    				$numPerRegion[$i]++;
		    				break;
		    			}
		    		}
	    		}
    		}
    		if ((int)substr($row['Message'], $monthStringStart, 2) == $currentMonth){
    			if (((int)substr($row['Message'], 1, 2) == $currentDate) && ((int)substr($row['Message'], $timeStringStart, $timeStringLength) == $currentHrIncrement)){
    				$past24HrArray[$j]++;
	    			$totalIncident++;
	    			for ($i = 0; $i < sizeof($regionArray); $i++){
		    			if ($row['region'] == $regionArray[$i]){
		    				$numPerRegion[$i]++;
		    				break;
						}
					}
    			}
    			else if (((int)substr($row['Message'], 1, 2) == $startingDay) && ((int)substr($row['Message'], $timeStringStart, $timeStringLength) >= $startingHr) && ((int)substr($row['Message'], $timeStringStart, $timeStringLength) == $currentHrIncrement)){
					$past24HrArray[$j]++;
		    		$totalIncident++;
		    		for ($i = 0; $i < sizeof($regionArray); $i++){
		    			if ($row['region'] == $regionArray[$i]){
		    				$numPerRegion[$i]++;
		    				break;
		    			}
		    		}
		    	}
    		}
    	}
    }
    $averageIncident = $totalIncident/24;
?>