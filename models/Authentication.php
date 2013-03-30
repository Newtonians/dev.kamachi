<?php
class Authentication extends Db{
	private $_email;
	private $_pwd;
	public function __construct($email, $password){
		$this->_email = $email;
		$this->_pwd = $password;
	}
	
	public function checkLogin(){
		$con = $this->getConnection();
		$result = mysqli_query($con,"SELECT * FROM employee where email = '" . $this->_email . "' and password = " . $this->_pwd);
		if($result){
			return true;
		}
		else{
			return false;
		}
	}
}