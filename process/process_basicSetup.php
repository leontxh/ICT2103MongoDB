<?php

   require '../ict2103mdb/vendor/autoload.php';

   $connect = new MongoDB\Client("mongodb://root:SITcloud9@dds-gs5cbb2e1fbc71c41684-pub.mongodb.singapore.rds.aliyuncs.com:3717,dds-gs5cbb2e1fbc71c42879-pub.mongodb.singapore.rds.aliyuncs.com:3717/admin?replicaSet=mgset-300213086&authSource=admin");
   $db = $connect ->ict2103;
//   $collection = $db->user;
//   $cursor = $collection->find();
//   foreach ( $cursor as $result)
//    {
//       echo "Connect successfully";
//       print_r($result);
//    }

?>
