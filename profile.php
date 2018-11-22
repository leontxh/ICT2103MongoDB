<?php
    include 'masterpage.php';
 ?>
<html>
    <head>

    </head>
   <body>
   <div class="container-fluid bg-1">
        <div class="row content">
            <div class="col-sm-1 sidenav">

            </div>
            <div class="col-sm-10 mainscreen">

                <div class="maincontent">
                    <div class="col-md-6"  >
                        <h1 class="username">
                            <?php echo "Welcome ";
                             echo $_SESSION['username']; ?>
                        </h1>

                        <div class="topSection">

                        </div>
                         <hr class="divider">
                         <h2>Change Your Password</h2>
                            <div class="bottomSection">

                            <form name="myForm" method="post" action='profile.php'>

                            <div class="changePw" >

                                <p>Old Password</p>
                                <input type="password" name="oldpassword" placeholder="Old Password"  class="changePw_input"id="oldPw">
                            </div>

                 <div class="changePw" >
                   <br>
                 <p>New Password</p>
                <input type="password" name="newpassword" placeholder="Please enter a new password with at least 8 characters"  class="changePw_input"id="fnewPw">
                 </div>

                  <div class="changePw">
                    <br>
                 <p>Confirm your new password</p>
                <input type="password" name="confirmpassword" placeholder="Confirm password"  class="changePw_input"id="cfmPw">
                  </div>
                  <br>
                <button type="submit" name="change" class="btn btn-danger">Change Password</button>
                                                    </form>


                <?php include('process/process_ChangePassword.php')?>
                    </div>
                    </div>
                              </div>
                                </div>
            <div class="col-sm-1" sidenav>

            </div>

        </div>
    </div>



      <link href="css/profile.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jsValidation.js"></script>

        </body>
</html>
