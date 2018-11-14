    <?php
    $verify = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ((empty($_POST["newpassword"])) || (empty($_POST["confirmpassword"])) || (empty($_POST["oldpassword"]))) {
            echo "<p style=\"color:red;\">Please fill in all entries</p>";
        }
        else
        {
            $verify = 1;
        }
    }
include 'process_basicSetup.php';
    
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

    if (isset($_POST['oldpassword'])) {
        $oldpassword = md5($_REQUEST['oldpassword']);
    }
    if (isset($_POST['newpassword'])) {
        $newpassword = md5($_REQUEST['newpassword']);
    }
    if (isset($_POST['confirmpassword'])) {
        $confirmpassword = md5($_REQUEST['confirmpassword']);
    }    
    if(isset($_POST['change']))
    {   if ($verify == 1)
        {
            if ($newpassword == $confirmpassword)
            {
                    $sql = "SELECT password FROM user where userID = ".$_SESSION['id'];
                    $run = mysqli_query($conn, $sql);
                    $fetch = mysqli_fetch_assoc($run);
                    
                    if(mysqli_num_rows($run) > 0) 
                    {
                        $passwordcheck = $fetch['password'];
                        if ($oldpassword == $passwordcheck)
                        {
                            if ($newpassword == $passwordcheck)
                            {
                                echo "<p style=\"color:red;\">New password cannot be the same as old password.</p>";
                            }
                            else if (strlen($newpassword) < 8)
                            {
                                echo "<p style=\"color:red;\">Please enter a new password with at least 8 characters.</p>";
                            }
                            else
                            {
                                $collection = $db->user;
                                $updateStatus = $collection -> updateOne(array("userID" => $_SESSION['id']), array('$set' => array("password" => $newpassword)));
                                $updateSql = "UPDATE user SET password = '$newpassword' WHERE userID = ".$_SESSION['id'];
                                echo "<p style=\"color:green;\">Password updated successfully.</p>";
                            }
                        }
                        else
                        {
                            echo "<p style=\"color:red;\">The old password that you have entered is not the same.</p>";
                        }
                    }
                }
                else
                {
                    echo "<p style=\"color:red;\">Please make sure your new passwords are the same.</p>";
                }
                // close connection
                mysqli_close($conn);
        }
    }
    ?>                