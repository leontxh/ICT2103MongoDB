<?php

class DBController {
	private $host = "rm-gs5py2dcox6x82w4l6o.mysql.singapore.rds.aliyuncs.com";
	private $user = "ict2103group6";
	private $password = "N0wubLgtMyWw";
	private $database = "group6";
	private $conn;
  	
        function __construct() {
        $this->conn = $this->connectDB();
	}	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
        function runQuery($query) {
                $result = mysqli_query($this->conn,$query);
                while($row=mysqli_fetch_assoc($result)) {
                $resultset[] = $row;
                }		
                if(!empty($resultset))
                return $resultset;
	}
}

?>

