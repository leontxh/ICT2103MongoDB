<?php
        $loginverify = 0;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ((empty($_POST["loginusername"])) || (empty($_POST["loginpassword"]))) {
                    $loginErr = "<p class='alert alert-danger'>Please enter your username and password";
                }
                else{
                    $loginverify = 1;
                }
            }
                    // Check connection
                    if($db === false)
                    {
                        die("ERROR: Could not connect. ");
                    }
                    if ($loginverify == 1){
                    if(isset($_POST['login']))
                    {
                        // Escape user inputs for security
                        $loginusername = $_REQUEST['loginusername'];
                        $loginpassword = md5($_REQUEST['loginpassword']);

                        $collection = $db->user;

                        $loginInfo = array("username" => $loginusername,
                                           "password" => $loginpassword);
                        $cursorFind = $collection->findOne($loginInfo);

                        if (!empty($cursorFind)){
                            session_start();
                            $_SESSION['id'] = $cursorFind['_id'];
                            $_SESSION['username'] = $cursorFind['username'];
                            header('Location: profile.php');
                        }
                         else
                        {
                            $loginErr = "<p class='alert alert-danger'>Username or password is incorrect</p>";
                        }
                    }
                }
            ?>
