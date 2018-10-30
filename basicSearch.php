<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'masterpage.php';
include 'DBController.php';
$db_handle = new DBController();
$typeResult = $db_handle->runQuery("SELECT DISTINCT tititle FROM traffic_incident");

session_start();
if(!isset($_SESSION['username'])){ //if login in session is not set
    header("Location: loginPage.php");
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
                    
                    <h2>Please select a option to filter</h2>
                    <form method="POST" name="search" action="basicSearch.php">
                        <div id="demo-grid">
                            <div class="search-box">
                                <select id="Place" name="tititle[]" multiple="multiple">
                                      <option value="0" selected="selected">Select type</option>
                                        <?php
                                        if (! empty($typeResult)) {
                                            foreach ($typeResult as $key => $value) {
                                                echo '<option value="' . $typeResult[$key]['tititle'] . '">' . $typeResult[$key]['tititle'] . '</option>';
                                            }
                                        }
                                        ?>
                                </select>
                                <br> <br>
                                <button id="Filter">Search</button>
                                <a href="traffictable.php">Back</a>

                            </div>

                                <?php
                                if (! empty($_POST['tititle'])) {
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
                                    $query = "SELECT * from traffic_incident";
                                    $i = 0;
                                    $selectedOptionCount = count($_POST['tititle']);
                                    $selectedOption = "";
                                    while ($i < $selectedOptionCount) {
                                        $selectedOption = $selectedOption . "'" . $_POST['tititle'][$i] . "'";
                                        if ($i < $selectedOptionCount - 1) {
                                            $selectedOption = $selectedOption . ", ";
                                        }

                                        $i ++;
                                    }
                                    $query = $query . " WHERE tititle in (" . $selectedOption . ")";

                                    $result = $db_handle->runQuery($query);
                                }
                                if (! empty($result)) {
                                    foreach ($result as $key => $value) {
                                        ?>
                                <tr>
                                        <td><?php echo $result[$key]['tititle']; ?></td>
                                        <td><?php echo $result[$key]['longitude']; ?> </td>
                                        <td><?php echo $result[$key]['latitude']; ?> </td>
                                        <td><?php echo $result[$key]['message']; ?> </td>
                                        <td><?php echo $result[$key]['status']; ?> </td>
                                        <td><?php echo $result[$key]['region']; ?> </td>
                                        <?php echo '<td width=250>';
                                            echo ' ';
                                            echo '<a class="btn btn-primary" href="viewIncident.php?trafficID='.$result[$key]['trafficID'].'">View</a>';
                                            echo ' ';
                                            echo '<a class="btn btn-success" href="update.php?trafficID='.$result[$key]['trafficID'].'">Update</a>';
                                            echo ' ';
                                            echo '<a class="btn btn-danger" href="delete.php?trafficID='.$result[$key]['trafficID'].'">Delete</a>';
                                            echo '</td>';
                                            echo '</td>'; ?>
                                    </tr>
                                <?php
                                    }
                                    ?>

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