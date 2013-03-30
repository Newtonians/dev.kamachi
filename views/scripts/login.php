<?php
session_start();
if(isset($_SESSION['email'])){
	header( 'Location: payslip.php' );
}
$errorMsg = "";
if(isset($_POST['login_ok_btn'])){
	$submit_value = $_POST['login_ok_btn'];
	if( $submit_value == 'login' ) {
		include('../../models/Db.php');
		include('../../models/Authentication.php');
		$db_obj = new Db();
		$email = $_POST['login_email'];
		$password = $_POST['login_password'];
		$auth_obj = new Authentication($email, $password);
		if($auth_obj->checkLogin()){
			$_SESSION['email'] = $email;
			header( 'Location: payslip.php' );
		}
		else{
			$errorMsg = "Check your Email & Password";
		}
	}

}?>
<html>
<head>
<title>Payslip - Login</title>
<link rel="stylesheet" href="../css/style.css" type="text/css">
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../js/common.js"></script>

</head>
<body>
	<form action="login.php" method="post">
		<div class="login_outer">
			<div class="error center">
			<?php
			echo $errorMsg;
			?>
			</div>
			<table class="login_inner">
				<tr>
					<td><label>Email</label></td>
					<td><input type="text" id="login_email" name="login_email"></td>
				</tr>
				<tr>
					<td><label>Password</label></td>
					<td><input type="password" id="login_password"
						name="login_password"></td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="btn_center">
							<input type="submit" id="login_ok_btn" value="login"
								name="login_ok_btn">
						</div>
					</td>
				</tr>
			</table>
		</div>
	</form>
</body>
</html>
