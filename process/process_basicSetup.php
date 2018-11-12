<?php

   require 'C:\xampp\htdocs\ICT2103MDB\vendor\autoload.php';
   
   $connect = new MongoDB\Client();
   $db = $connect ->ict2103;
//   $collection = $db->user;
//   $cursor = $collection->find();
//   foreach ( $cursor as $result) 
//    {
//       echo "Connect successfully";
//       print_r($result);
//    }

?>