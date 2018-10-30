<?php
	include "process/regionSorting.php";
	if (!count(debug_backtrace())) 
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_URL,  'http://datamall2.mytransport.sg/ltaodataservice/TrafficIncidents');

       $header = array(
          'AccountKey: Icfj/zB9SLiOYT5gkPfluw==',
          'Accept:application/pdf'
        );

       curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
       $result = curl_exec($ch);
       $data = json_decode($result, true);    
       //print_r($data);
       #print_r($data);
       
       curl_close($ch);
       
       include "process/process_basicSetup.php";
       if (!$conn) {
               die ('Failed to connect to MongoDB');	
    }
	$newArray = [];              
	array_push($newArray, $data['value']);
	//print_r($newArray[0][1]['Type']);
	$status = 'Unresolved';
	for ($i=0;$i<count($newArray[0]);$i++){
		$region = sortRegion($newArray[0][$i]["Longitude"], $newArray[0][$i]["Latitude"]);
                $collection = new MongoCollection($db,'traffic_incident');
                $trafficIncident= array("Type" => $newArray[0][$i]["Type"], "Longitude" => $newArray[0][$i]["Longitude"],
                                        "Latitude"=>$newArray[0][$i]["Latitude"], "Message" => $newArray[0][$i]["Message"],
                                        "status" => $status,"region"=>$region);
                $collection->insert($trafficIncident);
                    
              
                
                       
	
                }
	
?>