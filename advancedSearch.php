<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'masterpage.php';
include "process/process_basicSetup.php";
$collection = $db->traffic_incident;
$typeResult = $collection->distinct("Type");
$typeResult2 = $collection->distinct("region");;

session_start();
if(!isset($_SESSION['username'])){ //if login in session is not set
    header("Location: loginindex.php");

}
$date = new MongoDB\BSON\UTCDateTime((new DateTime('today'))->getTimestamp()*1000);

?>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<style>
    #Place, #Place2 {
        height: 120px;
        width: 120px;
    }

</style>

</head>
<iframe style="display:none;" name="target"></iframe>
  <div class="container-fluid bg-1">
        <div class="row content">
            <div class="col-sm-1 sidenav">

            </div>
            <div class="col-sm-10 mainscreen">

                <div class="maincontent">
<body>
<h1>Search Function for type & region</h1>
<h2>Please select both option to filter</h2>
<form method="GET" name="search" action="advancedSearch.php">
    <div id="demo-grid">
        <div class="search-box">
            <select id="Place" name="Type[]" multiple="multiple" style="width:150px;">
                  <option value="0" selected="selected">Select Type</option>
                    <?php
                    if (! empty($typeResult)) {
                        foreach ($typeResult as $key => $value) {
                            echo '<option value="' . $typeResult[$key] . '">' . $typeResult[$key] . '</option>';
                        }
                    }
                    ?>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select id="Place2" name="region[]" multiple="multiple" style="width:150px;">
                  <option value="0" selected="selected">Select Region</option>
                    <?php
                    if (! empty($typeResult2)) {
                        foreach ($typeResult2 as $key => $value) {
                            echo '<option value="' . $typeResult2[$key] . '">' . $typeResult2[$key] . '</option>';
                        }
                    }
                    ?>
            </select>

            <br> <br>
            <button id="Filter" class="btn btn-success">Search</button>
            <form>
              <input type="button" class="btn btn-warning" onclick="location.href='traffictable.php'" value="&laquo; Go back">
            </form>
        </div>

            <?php
            if (! empty($_GET['Type'])) {
                ?>



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
            <?php
                $collectionFind = $db->traffic_incident;
                $i = 0;
                $selectedOptionCount = count($_GET['Type']);
                $selectedOption = "";

                $results_per_page = 5;
                if (isset($_GET["page"]))
                {
                    $page  = $_GET["page"];

                } else {
                    $page=1;

                }
                $start_from = ($page-1) * $results_per_page;

                while ($i < $selectedOptionCount) {
                    $selectedOption = $selectedOption .$_GET['Type'][$i];
                    if ($i < $selectedOptionCount - 1) {
                        $selectedOption = $selectedOption . ", ";
                    }

                    $i ++;
                }

                $j = 0;
                $selectedOptionCount2 = count($_GET['region']);
                $selectedOption2 = "";
                while ($j < $selectedOptionCount2) {
                    $selectedOption2 = $selectedOption2 .$_GET['region'][$j];
                    if ($j < $selectedOptionCount2 - 1) {
                        $selectedOption2 = $selectedOption2 . ", ";
                    }

                    $j++;
                }

              $result = $collectionFind->find(array('Type' => $selectedOption,'region' => $selectedOption2,'date'=>$date),array('limit'=>$results_per_page, 'skip'=>$start_from));
            }
            if (! empty($result)) {
                foreach ($result as $doc) {
                    ?>
            <tr>
                   <?php
                                        $type = $doc['Type'];
                                        echo"<td>".$doc['Type']."</td>";
                                        echo"<td>".$doc['Longitude']."</td>";
                                        echo"<td>".$doc['Latitude']."</td>";
                                        echo"<td>".$doc['Message']."</td>";
                                        echo"<td>".$doc['status']."</td>";
                                        echo"<td>".$doc['region']."</td>";
                                        echo '<td width=250>';
                                       echo '<a class="btn btn-primary" href="viewIncident.php?trafficID='.$doc['_id'].'">View</a>';
                                        echo ' ';
                                        echo '<a class="btn btn-success" href="update.php?trafficID='.$doc['_id'].'">Update</a>';
                                              echo ' ';
                                              echo '<a class="btn btn-danger" href="delete.php?trafficID='.$doc['_id'].'">Delete</a>';
                                              echo '</td>';
                                        echo "</tr>";
                                    ?>
                                <?php

                                    }
                                    ?>
                                    <nav aria-label="Page navigation">
                                      <ul class="pagination">
                                    <?php

                                    $countOfType = $collection->count(array('Type' => $selectedOption,'region' => $selectedOption2,'date'=>$date));

                                    $total_pages = ceil( $countOfType / $results_per_page); // calculate total pages with results ?>
                                    <li>
                                      <?php
                                    for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
                                                echo "<a href='advancedSearch.php?Type[]=". $_GET['Type'][0]. "&region[]=". $_GET['region'][0] ."&page=".$i."'";
                                                if ($i==$page)  echo " class='curPage'";
                                                echo ">". $i ."</a> &nbsp;";
                                    };


                                    ?>
                                  </li>
            </tbody>
        </table>
        </div>
        <?php
            }
            ?>

    </div>
</form>
</div>
            </div>
            <div class="col-sm-1" sidenav>

            </div>

        </div>
    </div>

</body>
