<?php include 'masterpage.php'; ?>

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

    if (!$conn) {
            die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
    }
    $sql = "SELECT * FROM Traffic_incident WHERE trafficID = $trafficID";
    $query = mysqli_query($conn, $sql); 
    $data = mysqli_fetch_array($query);
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);

    $tititle = $data['tititle'];
    $longitude = $data['longitude'];
    $latitude = $data['latitude'];
    $message = $data['message'];
    $status = $data['status'];
?>
    <style>
      /* Always set the map height explicitly to define the size of the div
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
    
    

    
             <div class="content">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>View Traffic Incident</h3>
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
                       <div class="control-group <?php echo !empty($statusError)?'error':'';?>">
                        <label class="control-label">Status</label>
                         <div class="controls">
                            <input name="status" type="text"  disabled="true" value="<?php echo !empty($status)?$status:'';?>">
                            <?php if (!empty($statusError)): ?>
                                <span class="help-inline"><?php echo $statusError;?></span>
                            <?php endif;?>
                        </div>
                        </div>
                      </div>
                        
                        <div class="form-actions">
                            <a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a>
                        </div>
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