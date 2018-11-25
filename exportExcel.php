<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Connection 
include 'process/process_basicSetup.php';
$collection = $db->traffic_incident;

$date = new MongoDB\BSON\UTCDateTime((new DateTime('today'))->getTimestamp()*1000);

$cursor = $collection->find(array('date'=>$date));
		

if (!$cursor) {
	die ('Error');
}

header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=trafficincidents.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");


echo '<table border="1">';
//make the column headers what you want in whatever order you want
echo '<tr><th>Type</th><th>Longitude</th><th>Latitude</th><th>Message</th><th>Status</th><th>Region</th></tr>';
//loop the query data to the table in same order as the headers
foreach ($cursor as $row){
    echo "<tr><td>".$row['Type']."</td><td>".$row['Longitude']."</td><td>".$row['Latitude']."</td><td>".$row['Message']."</td><td>".$row['status']."</td><td>".$row['region']."</td></tr>";
}
echo '</table>';

?>

