<?php
    include 'process/process_basicSetup.php';
    $loginErr = "";
?>
<?php include ('process/process_register.php') ?>
<?php include ('process/process_login.php') ?>

<html lang="en">
<head>


        <title>SLTU</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/logintest.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
        $(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});

  </script>
</head>
<body>
        <nav class="navbar navbar-style navbar-fixed-top" id="mNavbar">

                <div class="navbar-header">
                    <img class="logo" src="logo.png">
                
                </div>
                <div class="collapse navbar-collapse" id="micon">
                    <ul class="nav navbar-nav">
                     <li><a href="loginindex.php">Home</a></li>
<!--                        <li><a href="traffictable.php">Traffic Incident</a></li>
                        <li><a href="googlemap.php">Map</a></li>-->

<!--                        <li><a href="process/process_phpLogout.php">Log Out</a></li>-->
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



                 <div class="loginui">

                        <div class="loginui-container">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="panel panel-login">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <a href="#" class="active" id="login-form-link">Login</a>
                                                </div>
                                                <div class="col-xs-6">
                                                    <a href="#" id="register-form-link">Register</a>
                                                </div>
                                            </div>
                                        <hr>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                    <form name="myForm" id="login-form" method="post" style="display: block;" onsubmit="return signValidate()">
                                                        <div class="form-group">
                                                            <input type="text" name="loginusername" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="loginpassword" id="password" tabindex="2" class="form-control" placeholder="Password">
                                                        </div>
                                                        <?php echo $loginErr; ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                            <div class="text-center">
                                                                <button id="submit" name="login" type="submit" class="btn btn-login btn-lg">Login</button>
                                                            </div>
                                                            </div>
                                                        </div>

                                                    </form>

                                                    <form id="register-form" method="post" role="form" style="display: none;" onsubmit="return validateSignup()">

                                                        <div class="form-group">
                                                            <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Please enter username with at least 5 characters." value="">
                                                            <?php echo $nameErr; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Please enter a valid email.">
                                                            <?php echo $emailErr; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Please enter password with at least 8 characters.">
                                                            <?php echo $passwordErr; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="passwordC" id="confirm-password" tabindex="2" class="form-control" placeholder="Please confirm your password">
                                                            <?php echo $cpasswordErr; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="text-center">
                                                                    <button id="submit" type="submit" name="submit3" class="btn btn-register btn-lg">Register Now</button>                                               
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                </div>
            <div class="col-sm-1" sidenav>

            </div>

        </div>
    </div>
</body>
</html>
