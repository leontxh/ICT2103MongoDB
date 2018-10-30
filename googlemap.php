<?php include 'masterpage.php' ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <?php
include 'process/process_basicSetup.php';
// Checking mysql connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$status='Unresolved';
$region = 'None';
// Writing a mysql query to retrieve data
$sql = "SELECT * FROM traffic_incident WHERE status = '$status' AND region <> '$region'";
$result = mysqli_query($conn,$sql);
$resultCheck = mysqli_num_rows($result);
?>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      
    </style>
  </head>
  <body>
           
      
      <div id="map">
           <script>
        
    var locations = [
     
    ];
        
        
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 1.3521, lng: 103.8198},
          zoom: 12
        });
        
        
            var infowindow = new google.maps.InfoWindow();

    var marker, i;

    //for (i = 0; i < locations.length; i++) {  
    <?php 
          if ($resultCheck > 0) {
        // Show each data returned by mysql
        while($row = mysqli_fetch_assoc($result)) {
    ?>
    
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(<?php echo $row["latitude"] ?>, <?php echo $row["longitude"] ?>),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent("<?php echo $row["message"] ?>");
          infowindow.open(map, marker);
        }
      })(marker, i));
      <?php
            } //end while
} //end if
else {
  echo "0 results";
}

// Closing mysql connection
$conn->close();
?>
        
      }//end init map
    </script>
          
      </div>
   
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOyCLiYkNnw4CcfkQn38YGFqRyEZoRC6k&callback=initMap" async defer>
                    </script>
  </body>
</html>