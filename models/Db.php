<?php
class Db{
	
	public function getConnection(){
		$con = mysqli_connect("localhost","root","","payslip");
		// Check connection
		if (mysqli_connect_errno($con)){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		else{
  			return $con;
  		}
	}
}