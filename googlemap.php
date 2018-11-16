<?php include 'masterpage.php' ?>
<!DOCTYPE html>
<html>
  <head>
    <title>SLTU</title>
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
          zoom: 12,
          disableDefaultUI: true
        });


        var infowindow = new google.maps.InfoWindow();
        var icons = {
          Accident: {
            icon: 'images/road.png'
          },
          "Vehicle breakdown": {
            icon: 'images/vehicle.png'
          },
          "Heavy Traffic": {
            icon: 'images/Heavy.png'
          },
          Obstacle: {
            icon: 'images/obstacle.png'
          },
          Roadwork: {
            icon: 'images/major.png'
          },
          "Road Block": {
            icon: 'images/block.png'
          },
          "Unattended Vehicle": {
            icon: 'images/obstacle.png'
          }
        };
        <?PHP foreach($cursor as $docx){ ?>
var marker, i;
var features = [
  {
    position: new google.maps.LatLng(<?php echo $docx["Latitude"] ?>, <?php echo $docx["Longitude"] ?>),
    type: '<?php echo $docx["Type"] ?>'
  }
];

// Create markers
features.forEach(function(feature) {
  var marker = new google.maps.Marker({
    position: feature.position,
    icon: icons[feature.type].icon,
    map: map
  });
  google.maps.event.addListener(marker, 'click', (function(marker, i) {
    return function() {
      infowindow.setContent("<?php echo "<p style='font-size:25px; font-weight: bolder'>" ?> <?php echo $docx["Type"] ?> <?php echo "</p>" ?><?php echo $docx["Message"] ?>");
      infowindow.open(map, marker);
    }
  })(marker, i));
});

<?PHP } ?>

      }//end init map
    </script>


      </div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOyCLiYkNnw4CcfkQn38YGFqRyEZoRC6k&callback=initMap" async defer>
                    </script>
  </body>
</html>
