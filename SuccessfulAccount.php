<?php 
    include 'process/process_basicSetup.php';
?>

<html>
    <head>
        <title>SLTU</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/logintest.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <nav class="navbar navbar-style navbar-fixed-top" id="mNavbar">

                <div class="navbar-header">
                    <img class="logo" src="logo.png">
                
                </div>
                <div class="collapse navbar-collapse" id="micon">
                    <ul class="nav navbar-nav">
                        <li><a href="loginindex.php">Home</a></li>
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
        <div class="container-fluid bg-1">
        <div class="row content">
            <div class="col-sm-1 sidenav">
                
            </div>
            <div class="col-sm-10 mainscreen">
     
                <div class="maincontent">
                <div class="col-md-12"><p><h1>Account created successfully</h1></p></div>
            </div>
            <div class="row">
                <div class="col-md-12 backpane">
                    <a href="loginindex.php"><h4><center>Sign in here.</center></h4></a>
                    
                </div>
            </div>
        </div>
                       
            <div class="col-sm-1" sidenav>
                
            </div>
                 
        
           </div>
                                </div>
         <script type="text/javascript" src="js/jsValidation.js"></script>
    </body>
</html>
