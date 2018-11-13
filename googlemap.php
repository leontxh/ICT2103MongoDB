<?php // include 'masterpage.php' ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <?php
include 'process/process_basicSetup.php';
$status='Unresolved';
$region = 'None';
$collection = $db->traffic_incident;
$cursor = $collection->find(array("status" => $status,"region" => array('$ne' => $region)));



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
          zoom: 11
        });
        
        
            var infowindow = new google.maps.InfoWindow();

    var marker, i;

    //for (i = 0; i < locations.length; i++) {  

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(<?php echo $value["Latitude"] ?>, <?php echo $value["Longitude"] ?>),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent("<?php echo $value["Message"] ?>");
          infowindow.open(map, marker);
        }
      })(marker, i));

        
      }//end init map
    </script>
   
         
      </div>
   
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOyCLiYkNnw4CcfkQn38YGFqRyEZoRC6k&callback=initMap" async defer>
                    </script>
  </body>
</html>