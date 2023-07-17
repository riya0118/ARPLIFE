<?php
session_start();
if (!isset($_SESSION['loginerrorflag']) || $_SESSION['loginerrorflag'] == '') {
	$_SESSION['loginerrorflag'] = 0;
}
?>
<?php
if ($_SESSION['loginerrorflag'] == 1) { ?>
	<div  style="margin-bottom:0px; text-align:center; font-size: large; " id="danger-alert" class="alert alert-danger"><b> Incorrect Credentials !</b> Please try again .</div>
<?php	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<title>Admin Login</title>
	<?php require_once("../admin/includes/constants.php"); ?>
	<?php include(INCLUDESCOMP_DIR . "csslinks.php"); ?>
</head>



<body style="background-color:white;">
	<?php include(INCLUDESCOMP_DIR . "preloader.php"); ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

				<form action="functions/authentication.php" method="POST" class="login100-form validate-form" style="padding-top:100px ;">
					<div style="margin:0px ; padding-bottom:40px ; ">
						<a style="color:slateblue; font-size: large;  " href="./index.php">
							< Home</a>
					</div>
					<span class="login100-form-title p-b-43">
						Admin Login
					</span>


					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email_username" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="label-input100">Email / Username</span>
					</div>


					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>


					<div class="container-login100-form-btn">
						<button type="submit" name="loginbtn" class="login100-form-btn">
							Login
						</button>
					</div>

				</form>

				<div class="login100-more" style="width: calc(100% - 560px) !important ; background-image: url('images/logincover.jpg');">
				</div>
			</div>
		</div>
	</div>





	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/custom.min.js"></script>
	<script>
		$("#danger-alert").fadeTo(2000, 500).slideUp(500, function() {
			$("#danger-alert").slideUp(500);
		});
	</script>

</body>

</html>