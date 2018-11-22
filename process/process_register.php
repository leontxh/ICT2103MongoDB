<?php 
    $nameErr = $passwordErr = $cpasswordErr = $emailErr = "";
    $mailFormat = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    $nameFormat = "/A-Za-z/";
    
    include 'process_basicSetup.php';
    
	// Check connection
        if($db === false) {
            die("ERROR: Could not connect.");
        }
	if(isset($_POST['submit3']))
	{
        // Escape user inputs for security
        $username = $_REQUEST['username'];
        $password = md5($_REQUEST['password']);
        $email = $_REQUEST['email'];
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
        else if ($_POST["password"] != $_POST["passwordC"])
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
            $collection = $db->user;
//
//            $insert = array("username"  => $username,
//                                "password" => $password,
//                                "email" => $email);
//            $collection->insertOne($insert);
//            header("Location: SuccessfulAccount.php");

            $checkExistingUsername = array("username" => $username);
            $cursorFind = $collection->findOne($checkExistingUsername);
            if (!empty($cursorFind)){
              $nameErr = "Username already exists, please use a different username";
            }
            else
            {   
                $insert = array("username"  => $username,
                                "password" => $password,
                                "email" => $email);
                $collection->insertOne($insert);
                header('Location: SuccessfulAccount.php');
            }
        }
    }
?>
