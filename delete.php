<?php
include 'masterpage.php';
    if ( !empty($_GET['trafficID'])) {
        $trafficID = $_REQUEST['trafficID'];
    }
     if ( null==$trafficID ) {
        header("Location: traffictable.php");
    }
    
    if ( !empty($_POST)) {
     include 'process/process_basicSetup.php';
    if (!$conn) {
            die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
    }
    $trafficID = $_REQUEST['trafficID'];
    $sql = "DELETE FROM Traffic_incident WHERE trafficID = $trafficID";
    $query = mysqli_query($conn, $sql); 
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header("Location: traffictable.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    }
?>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<style>
    #Place {
        height: 120px;
        width: 120px;
    }
    
</style>

</head>
<iframe style="display:none;" name="target"></iframe>
<body>
    <div class="container-fluid bg-1">
        <div class="row content">
            <div class="col-sm-1 sidenav">
                
            </div>
            <div class="col-sm-10 mainscreen">
     
                <div class="maincontent">
                    
         <div class="span10 offset1">
                    <div class="row">
                        <h3>Delete this record?</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete.php" method="post">
                      <input type="hidden" name="trafficID" value="<?php echo $trafficID;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a href="javascript:history.go(-1)">No</a>
                          
                          <br> <br>
                          
                          <a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back to previous page</a>
                        </div>
                    </form>
                </div>
                        </div>
                    </form>




  		</div>
            </div>
            <div class="col-sm-1" sidenav>
                
            </div>
                 
        </div>
    </div>


</body>

\