 <?php include 'process/process_register.php';?>


<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>RTF</title>

    </head>
    
    <body>
        <div class="container">
            <div class="row heading">
                <div class="col-md-1"><p>Register</p></div>
            </div>
            <div class="row">
                <div class="col-md-12 backpane">
                    <form name ="myForm" method ='post' action='#' onsubmit="return validateSignup()" class="form-horizontal spacing">
                        <div class="form-group">
                            <label class="control-label col-md-4" for="username">Username:</label>
                            <div class="col-md-5"><input name="username" type="text" class="form-control" placeholder="Please enter a username with at least 5 characters."></div>
                            <?php echo $nameErr;?>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4" for="email">Email:</label>
                            <div class="col-md-5"><input name="email" type="email" class="form-control" placeholder="Please enter a valid email."></div>
                            <?php echo $emailErr;?>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4" for="password">Password:</label>
                            <div class="col-md-5"><input name="password" type="password" class="form-control" placeholder="Please enter a password with at least 8 characters."></div>
                            <?php echo $passwordErr;?>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4" for="confirmpassword">Confirm Password:</label>
                            <div class="col-md-5"><input name="passwordC" type="password" class="form-control" placeholder="Please confirm your password."></div>
                            <?php echo $cpasswordErr;?>
                        </div>
                        <div class="form-group"> 
                                <button class="btn_submit" id="submit" type="submit" name="submit" class="btn btn-default">Submit</button>
                            
                        </div>
                        <h4> <a class="registerLink" href="loginPage.php">Already have an account? Login here.</a></h4>
                    </form>
                    
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/jsValidation.js"></script>
    </body>
</html>