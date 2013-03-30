<?php
require 'Db.php';

class Payslip extends Db{
	private $_con;
	private $_query;

	public function __construct(){
		$this->_con = $this->getConnection();
	}
	public function getPayslipDetailsByEmail($email){
		$this->_query = "SELECT * FROM employee as e, salary as s, designation d, company c where e.email = '" . $email . "' and e.id = s.employee_id and s.designation_id = d.id and s.company_id = c.id";
		$result = mysqli_query($this->_con, $this->_query);
		if($item = mysqli_fetch_row($result)){
			return $item;
		}
	}
	public function getConstantValue($constant){
		$this->_query = "SELECT value FROM constants where constant = '" . $constant . "'";
		$result = mysqli_query($this->_con, $this->_query);
		if($item = mysqli_fetch_row($result)){
			return $item;
		}
	}
	public function getPercentageValue($value, $percentage){
		$result = $value * ( $percentage / 100 );
		return $result;
	}
}