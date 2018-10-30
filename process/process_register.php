<?php
    $nameErr = $passwordErr = $cpasswordErr = $emailErr = "";
    $mailFormat = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    $nameFormat = "/A-Za-z/";
    
    include 'process_basicSetup.php';
    
	// Check connection
        if($conn === false)
        {
            die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	if(isset($_POST['submit']))
	{
            // Escape user inputs for security
            $username = mysqli_real_escape_string($conn, $_REQUEST['username']);
            $password = mysqli_real_escape_string($conn, md5($_REQUEST['password']));
            $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
            $msg = 'Your account has been made.';
            
            if (empty($_POST["username"])) {
                    $nameErr = "Please enter your username";
                }
                else if (strlen($_POST["username"]) < 5) {
                    $nameErr = "Please enter a username with at least 5 characters";
                }
                if (empty($_POST["password"])) {
                    $passwordErr = "Please enter your password";
                }
                else if (strlen($_POST["password"]) < 8) {
                    $passwordErr = "Please enter a password with at least 8 characters";
                }
                if (empty($_POST["passwordC"])) {
                    $cpasswordErr = "Please confirm your password";
                }
                else if ($_POST["password"] !== $_POST["passwordC"])
                {
                    $cpasswordErr = "Please ensure your password is the same";
                }
                if (empty($_POST["email"])) {
                    $emailErr = "Please enter the email";                 
                }
                else if (!preg_match($mailFormat,$_POST["email"])) {
                    $emailErr = "Email is in wrong format";                
                }
                if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["passwordC"]) && !empty($_POST["email"]) 
                        && $nameErr == "" && $passwordErr == "" && $cpasswordErr == "" && $emailErr == "")
                {
                    $selectSql = "SELECT username FROM user where username='$username'";
                    $run = mysqli_query($conn, $selectSql);
                    $fetch = mysqli_fetch_assoc($run);
                    if(mysqli_num_rows($run) > 0)
                    {
                        $nameErr = "Username already exists, please use a different username";
                    }
                    else
                    {
                        $sql = "INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email')";
                        if ($conn->query($sql) === TRUE){
                             header("Location: SuccessfulAccount.php");
                        }
                        else
                        {
                          echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
        }
        
                    }
            
?>