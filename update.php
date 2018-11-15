<?php  include 'masterpage.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <?php
// Server credentials
     if ( !empty($_GET['trafficID'])) {
        $trafficID = $_REQUEST['trafficID'];
    }
     if ( null==$trafficID ) {
        header("Location: trafficTable.php");
    }
    include 'process/process_basicSetup.php';

    $collection = $db->traffic_incident;
    $cursor = $collection->findOne(array("_id" => (new MongoDB\BSON\ObjectID($trafficID))));

    $tititle = $cursor['Type'];
    $longitude = $cursor['Longitude'];
    $latitude = $cursor['Latitude'];
    $message = $cursor['Message'];
    $status = $cursor['status'];
    $region = $cursor['region'];

       if (!empty($_POST)){
        $selected_val = $_POST['status'];
        try {
            $updateStatus = $collection -> updateOne(array("_id" => (new MongoDB\BSON\ObjectID($trafficID))), array('$set' => array("status" => $selected_val)));
            echo '<script language="javascript">
                alert("Update Successfully");
        </script>';
        } catch(MongoCursorException $e) {
             echo '<script language="javascript">
                alert("Update fail");
        </script>';
        }

   }
?>
    <style>
      /* Always set the map height explicitly to defiane the size of the div
       * element that contains the map. */
      #map {
        height: 40%;
        width:50%;
        margin-left: 500px;
        position: absolute;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 15;
        padding: 20;
      }

      .content {
          padding-left: 50px;
      }
    </style>
  </head>
  <body>

          <div class="container-fluid bg-1">
        <div class="row content">
            <div class="col-sm-1 sidenav">

            </div>
            <div class="col-sm-10 mainscreen">

                <div class="maincontent">
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
        position: new google.maps.LatLng(<?php echo $cursor["Latitude"] ?>, <?php echo $cursor["Longitude"] ?>),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent("<?php echo $cursor["Message"] ?>");
          infowindow.open(map, marker);
        }
      })(marker, i));


      }//end init map
    </script>

      </div>




             <div class="content">

                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update Traffic Incident</h3>
                    </div>

                    <form class="form-horizontal"  method="post">
                      <div class="control-group <?php echo !empty($typeError)?'error':'';?>">
                        <label class="control-label">Type</label>
                        <div class="controls">
                            <input name="Type" type="text" disabled="true" value="<?php echo !empty($tititle)?$tititle:'';?>">
                            <?php if (!empty($typeError)): ?>

                                <span class="help-inline"><?php echo $typeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($longitudeError)?'error':'';?>">
                        <label class="control-label">Longitude</label>
                        <div class="controls">
                            <input name="longitude" type="text" disabled="true" value="<?php echo !empty($longitude)?$longitude:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $longitudeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($latitudeError)?'error':'';?>">
                        <label class="control-label">Latitude</label>
                        <div class="controls">
                            <input name="latitude" type="text"  disabled="true" value="<?php echo !empty($latitude)?$latitude:'';?>">
                            <?php if (!empty($latitudeError)): ?>
                                <span class="help-inline"><?php echo $latitudeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                        <div class="control-group <?php echo !empty($messageError)?'error':'';?>">
                        <label class="control-label">Message</label>
                        <div class="controls">
                            <textarea name="message"  style="height:200px;width:400px;" type="text"  disabled="true"><?php echo !empty($message)?$message:'';?></textarea>
                            <?php if (!empty($messageError)): ?>
                                <span class="help-inline"><?php echo $messageError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                  <div class="control-group <?php echo !empty($regionError)?'error':'';?>">
                        <label class="control-label">Region</label>
                         <div class="controls">
                            <input name="status" type="text"  disabled="true" value="<?php echo !empty($region)?$region:'';?>">
                            <?php if (!empty($regionError)): ?>
                                <span class="help-inline"><?php echo $regionError;?></span>
                            <?php endif;?>
                        </div>
                        </div>
                      </div>
                     <div class="control-group <?php echo !empty($statusError)?'error':'';?>">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <select name = "status">
                                <option value="Resolved">Resolved</option>
                                <option value="Unresolved">Unresolved</option>
                            </select>
                        </div>
                      </div>
                      <br>
                        <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <input type="button" class="btn btn-warning" onclick="location.href='traffictable.php'" value="&laquo; Go back">
                        </div>
                                    </div>
                </div>
            <div class="col-sm-1" sidenav>

            </div>
        </div>
 </div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOyCLiYkNnw4CcfkQn38YGFqRyEZoRC6k&callback=initMap" async defer>
                    </script>
  </body>
</html>
