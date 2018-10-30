<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Connection 
include 'process/process_basicSetup.php';
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

$sql = 'select trafficID, tititle, longitude, latitude, message, status, region from traffic_incident';
		
$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}

header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=trafficincidents.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");


echo '<table border="1">';
//make the column headers what you want in whatever order you want
echo '<tr><th>traffic ID</th><th>title</th><th>longitude</th><th>latitude</th><th>message</th><th>status</th><th>region</th></tr>';
//loop the query data to the table in same order as the headers
while ($row = mysqli_fetch_assoc($query)){
    echo "<tr><td>".$row['trafficID']."</td><td>".$row['tititle']."</td><td>".$row['longitude']."</td><td>".$row['latitude']."</td><td>".$row['message']."</td><td>".$row['status']."</td><td>".$row['region']."</td></tr>";
}
echo '</table>';

?>

