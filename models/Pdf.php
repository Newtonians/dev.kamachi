<?php
require 'fpdf.php';

class Pdf extends FPDF{

	public $data;

	public function createFourColumnCell($value){
		$this->SetFont('Arial', $value[2], 9);
		$this->Cell(42, 6, $value[0], 'BLR', 0, '');
		$this->Cell(42, 6, $value[1], 'BLR', 0, '');
		$this->SetFont('Arial', $value[5], 9);
		$this->Cell(42, 6, $value[3], 'BLR', 0, '');
		$this->Cell(42, 6, $value[4], 'BLR', 1, '');
	}

	public function createTable($details, $email, $dload){
		$this->SetMargins(25, 50);
		$this->AddPage();
		$this->SetAuthor('Finance Department');
		$this->SetCreator($details[30]);
		// Colors, line width and bold font
		$this->SetFont('Arial','B',15);
		$this->SetFillColor(255,0,0);
		$this->SetTextColor(0);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.2);

		$this->Cell(168, 10, $details[30], 'LTR', 1, 'C');
		$this->SetFont('Arial', '', 10);
		$this->Cell(168, 4, $details[31], 'BLR', 1, 'C');
		$this->SetFont('Arial', 'BU', 8);
		$this->Cell(168, 4, "Salary Slip", 'BLR', 1, 'C');
		$this->SetFont('Arial', '', 9);
		$this->Cell(168, 4, "", 'LR', 1, '');
		$this->Cell(168, 4, "Name of the Employee : " . $details[2] . " " .$details[3], 'LR', 1, 'L');
		$this->Cell(168, 4, "Designation                   : " . $details[22], 'LR', 1, 'L');
		$month = date('F', strtotime($details[15]));
		$year = date('Y', strtotime($details[15]));
		$this->Cell(168, 4, "Month & Year                : " . $month . ", " . $year, 'LR', 1, 'L');
		$this->Cell(168, 4, "", 'BLR', 1, '');

		$payslip_obj = new Payslip();
		$da = $payslip_obj->getConstantValue('DA');
		$pf = $payslip_obj->getConstantValue('PF');

		$da_calculated = $payslip_obj->getPercentageValue($details[23], $da[0]);
		$pf_calculated = $payslip_obj->getPercentageValue($details[23], $pf[0]);
		$esi = $payslip_obj->getConstantValue('ESI');

		$basic_da = $details[23] + $da_calculated;
		$total_addition =  $basic_da +  $details[24] +  $details[25];
		$total_deduction = $pf_calculated + $esi[0];
		$net = $total_addition - $total_deduction;

		$data = array(
			'0' => array('Earnings','','BU','Deductions','','BU'),
			'1' => array('Basic & DA', $basic_da,'','Provident Fund', $pf_calculated,''),
			'2' => array('HRA', $details[24],'','E.S.I', $esi[0],''),
			'3' => array('Conveyance', $details[25],'','Loan','',''),
			'4' => array('','','','Profession Tax','',''),
			'5' => array('','','','TDS/IT','',''),
			'6' => array('','','','','',''),
			'7' => array('Total Addition', $total_addition,'','Total Deduction', $total_deduction,''),
			'8' => array('','','','Net Salary', $net,'B')
		);

		foreach ($data as $key => $value){
			$this->createFourColumnCell($value);
		}

		$this->Cell(118, 6, "", 'L', 0, 'R');
		$this->SetFont('Arial', 'B', 9);
		$this->Cell(50, 6, "For " . $details[30], 'R', 1, 'C');
		$this->Cell(168, 6, '', 'LR', 1, '');
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(118, 6, "Signature of the Employee", 'LB', 0, 'L');
		$this->SetFont('Arial', '', 8);
		$this->Cell(50, 6, "Director", 'BR', 1, 'C');

		if($dload == 1){
			$this->Output($email . '.pdf', 'D');
		}

		return array($basic_da, $pf_calculated, $esi[0], $total_addition , $total_deduction, $net, $month, $year);
	}
}