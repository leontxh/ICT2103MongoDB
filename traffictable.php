<!doctype html>
<html>
 <?php
include 'masterpage.php';
include 'process/process_basicSetup.php';

$results_per_page = 20;


if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $results_per_page;
$collection = $db->traffic_incident;
//$cursor = $collection->find(['limit'=>$start_from]);
$cursor = $collection->find();


//session_start();
//if(!isset($_SESSION['username'])){ //if login in session is not set
//   header("Location: loginPage.php");
//}


?>
<head>
<meta charset="utf-8">
<title>Show Traffic Incident Record</title>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="js/jquery.table_sort.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<iframe style="display:none;" name="target"></iframe>
<body>

    <div class="container-fluid bg-1">
        <div class="row content">
            <div class="col-sm-1 sidenav">

            </div>
            <div class="col-sm-10 mainscreen">

                <div class="maincontent">

                    <button><a href='api.php' target="target" onclick="return RefreshWindow();">Update Table</a></button>

                    <script language='javascript'>
                        function RefreshWindow()
                        {
                            window.location.reload(true);
                        }
                        
                        
                    </script>

                    <button><a href="exportExcel.php" target="target" >Download Excel</a></button>

                    <button><a href="basicSearch.php">Search by Type</a></button>

                    <button><a href="advancedSearch.php">Search by Type & Region</a></button>

                    <button><a href="profile.php">Go back to profile</a></button>
                    

                    <div class="container">

                    <table class="table table-bordered">
                     <thead>
                     <tr>
                     <th>Type</th>
                     <th>Longitude</th>
                     <th>Latitude</th>
                     <th>Message</th>
                     <th>Status</th>
                     <th>Region</th>
                     </tr>
                     </thead>
                     <tbody>
                     <tr>
                     <?php
                     foreach($cursor as $doc)
                     {
                     $type = $doc['Type'];
                     echo"<td>".$doc['Type']."</td>";
                     echo"<td>".$doc['Longitude']."</td>";
                     echo"<td>".$doc['Latitude']."</td>";
                     echo"<td>".$doc['Message']."</td>";
                     echo"<td>".$doc['status']."</td>";
                     echo"<td>".$doc['region']."</td>";
                     echo '<td width=250>';
                     echo ' ';
                     echo '<a class="btn btn-primary" href="viewIncident.php?trafficID='.$doc['_id'].'">View</a>';
                     echo ' ';
                     echo '<a class="btn btn-success" href="update.php?trafficID='.$doc['_id'].'">Update</a>';
                           echo ' ';
                           echo '<a class="btn btn-danger" href="delete.php?trafficID='.$doc['_id'].'">Delete</a>';
                           echo '</td>';
                     echo "</tr>";
                     }
                     ?>

                    <?php
                    
                    //$sql = "SELECT COUNT(trafficID) AS total FROM traffic_incident";
//                    $cursorFind = $collection->find(array("_id" => (new MongoDB\BSON\ObjectID())));
//                    $total = count(var_dump($cursorFind));
//                     //$result = $conn->query($sql);
//                     //$row = $result->fetch_assoc();
//                     $total_pages = ceil( $total / $results_per_page); // calculate total pages with results
//
//                     for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
//                                 echo "<a href='trafficTable.php?page=".$i."'";
//                                 if ($i==$page)  echo " class='curPage'";
//                                 echo ">". $i ."</a> &nbsp;";
//                     };
                    ?>

                    </table>

                    </div>




  		</div>
            </div>
            <div class="col-sm-1" sidenav>

            </div>

        </div>
    </div>



</body>
</html>
