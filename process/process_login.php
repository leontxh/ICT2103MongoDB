<?php
        $loginverify = 0;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ((empty($_POST["loginusername"])) || (empty($_POST["loginpassword"]))) {
                    $loginErr = "Please enter your username and password";
                }
                else{
                    $loginverify = 1;
                }
            }
                    // Check connection
                    if($conn === false)
                    {
                        die("ERROR: Could not connect. " . mysqli_connect_error());
                    }
                    if ($loginverify == 1){
                    if(isset($_POST['login']))
                    {
                        // Escape user inputs for security
                        $loginusername = mysqli_real_escape_string($conn, $_REQUEST['loginusername']);
                        $loginpassword = mysqli_real_escape_string($conn, md5($_REQUEST['loginpassword']));
                            
                        // attempt insert query execution
                        $sql = "SELECT userID, username, password FROM user where username='$loginusername' AND password='$loginpassword'";
                        $run = mysqli_query($conn, $sql);
                        $fetch = mysqli_fetch_assoc($run);
                        if(mysqli_num_rows($run) > 0)
                        {
                        
                                session_start();
                                $_SESSION['id'] = $fetch['userID'];
                                $_SESSION['username'] = $fetch['username'];
                                //echo "<p style=\"color:red;\">".$_SESSION['id']."</p>";
                               header('Location: profile.php');
                         
                        }
                        else 
                        {
                            $loginErr = "<p style=\"color:red;\">Username or password is incorrect</p>";
                        }
                    // close connection
                    mysqli_close($conn);
                    }
                }
            ?>