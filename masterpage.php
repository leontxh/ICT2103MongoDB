 <?php
    session_start();
    $id=$_SESSION['id'];
    if(!$_SESSION['id']){
        header('Location: loginindex.php');
    }
    include 'process/process_basicSetup.php';
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>SLTU</title>
        <link rel="stylesheet" type="text/css" href="css/style.css?d=<?php echo time(); ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css?d=<?php echo time(); ?>">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="shortcut icon" href="images/icon.ico" type="image/x-icon"/>
    </head>
    <body>

        <nav class="navbar navbar-style navbar-fixed-top" id="mNavbar">

                <div class="navbar-header">
                    <a href="loginindex.php"><img class="logo" src="logo.png"></a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#micon">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="micon">
                    <ul class="nav navbar-nav">
                        <li><a href="profile.php">Home</a></li>
                        <li><a href="traffictable.php">Traffic Incident</a></li>
                        <li><a href="googlemap.php">Map</a></li>
                        <li><a href="chart.php">Dashboard</a></li>
                        <li><a href="process/process_phpLogout.php">Log Out</a></li>
                    </ul>

                    </ul>
                </div>

            <script>
                $(document).ready(function() {
                    var $navbar = $("#mNavbar");

                    AdjustHeader(); // Incase the user loads the page from halfway down (or something);
                    $(window).scroll(function() {
                        AdjustHeader();
                    });

                    function AdjustHeader(){
                        if ($(window).scrollTop() > 60) {
                            if (!$navbar.hasClass("navbar-fixed-top")) {
                                $navbar.addClass("navbar-fixed-top");
                            }
                        } else {
                            $navbar.addClass("navbar-fixed-top");
                        }
                    }
                });
            </script>

        </nav>





    </body>

</html>
