<?php
session_start();
if(!isset($_SESSION['email'])){
	header( 'Location: login.php' );
}
if(isset($_GET['dload'])){
	$dload = 1;
}
else{
	$dload = 0;
}
?>
<html>
<head>
<title>Payslip - view</title>
<link rel="stylesheet" href="../css/style.css" type="text/css">
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<style type="text/css">
tr,td {
	border: 1px solid darkgreen;
}
</style>
</head>
<body bgcolor="grey">
	<div class="logout_outer">
		<a href="logout.php" style="margin-left: 13px;">logout</a>
	</div>
	<?php
	include '../../models/Pdf.php';
	include '../../models/Payslip.php';

	$create_pdf = new Pdf();
	$payslip = new Payslip();
	$payslip_details = $payslip->getPayslipDetailsByEmail($_SESSION['email']);
	$data = $create_pdf->createTable($payslip_details, $_SESSION['email'], $dload);
	?>
	<table class="center payslip_outer">
		<tr class="bck_color">
			<td style="font-size: 25px;" colspan="4" class="bold text_center"><?php echo $payslip_details[30] . "<br><div style='margin-top:3px;font-weight:normal;font-size:17px;'>" . $payslip_details[31] ."</div>";?>
			</td>
		</tr>
		<tr>
			<td style="font-size: 15px;" colspan="4"
				class="bold uline text_center">Salary Slip</td>
		</tr>
		<tr>
			<td colspan="4">Name of the Employee&nbsp;:&nbsp;<?php echo $payslip_details[2] . " " . $payslip_details[3];?>
			</td>
		</tr>
		<tr>
			<td colspan="4">Designation&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $payslip_details[22];?>
			</td>
		</tr>
		<tr>
			<td colspan="4">Month&nbsp;&amp;&nbsp;Year&emsp;&emsp;&emsp;&nbsp;:&nbsp;<?php echo $data[6] . ", " . $data[7];?>
			</td>
		</tr>
		<tr class="bck_color">
			<td style="font-size: 20px;" class="bold uline">Earnings</td>
			<td></td>
			<td style="font-size: 20px;" class="bold uline">Deductions</td>
			<td></td>
		</tr>
		<tr>
			<td>Basic&nbsp;&amp;&nbsp;DA</td>
			<td><?php echo $data[0];?></td>
			<td>Provident Fund</td>
			<td><?php echo $data[1];?></td>
		</tr>
		<tr>
			<td>HRA</td>
			<td><?php echo $payslip_details[24];?></td>
			<td>E.S.I</td>
			<td><?php echo $data[2];?></td>
		</tr>
		<tr>
			<td>Conveyance</td>
			<td><?php echo $payslip_details[25];?></td>
			<td>Loan</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Profession Tax</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>TDS/IT</td>
			<td></td>
		</tr>
		<tr>
			<td>Total Addition</td>
			<td><?php echo $data[3];?></td>
			<td>Total Deduction</td>
			<td><?php echo $data[4];?></td>
		</tr>
		<tr class="bck_color"">
			<td></td>
			<td></td>
			<td style="font-size: 20px;" class="bold">Net Salary</td>
			<td style="font-size: 20px;" class="bold"><?php echo $data[5];?></td>
		</tr>
	</table>
	<div class="pdf"><a href="payslip.php?dload=1zy34d">Download PDF</a></div>
</body>
</html>
