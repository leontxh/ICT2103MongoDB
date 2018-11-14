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
    
// Create connection to table
$collection = $db->user;

    if (isset($_POST['oldpassword'])) {
        $oldpassword = md5($_REQUEST['oldpassword']);
    }
    if (isset($_POST['newpassword'])) {
        $newpassword = md5($_REQUEST['newpassword']);
    }
    if (isset($_POST['confirmpassword'])) {
        $confirmpassword = md5($_REQUEST['confirmpassword']);
    }    
    if(isset($_POST['change'])){
       if ($verify == 1){
            if ($newpassword == $confirmpassword){
                $idInfo = array("userID"  => $_SESSION['id']);
                $cursorFind = $collection->findOne($idInfo);
                
                if ($oldpassword == md5($cursorFind['password'])){
                    if ($newpassword == $cursorFind['password'])
                        echo "<p style=\"color:red;\">New password cannot be the same as old password.</p>";
                    else if (strlen($newpassword) < 8)
                        echo "<p style=\"color:red;\">Please enter a new password with at least 8 characters.</p>";
                    else{
                        $updateStatus = $collection -> updateOne(array("userID" => $_SESSION['id']), array('$set' => array("password" => $newpassword)));
                        echo "<p style=\"color:green;\">Password updated successfully.</p>";
                    }
                }
                else{
                    echo "<p style=\"color:red;\">The old password that you have entered is not the same.</p>";
                    echo $oldpassword;
                    echo "<br>";
                    echo md5($cursorFind['password']);}
            }
            else{
                echo "<p style=\"color:red;\">Please make sure your new passwords are the same.</p>";
                echo $newpassword;
                 echo "<br>";
                echo $confirmpassword;
            // close connection
            }
        }
    }
?>                