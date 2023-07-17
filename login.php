<?php
$ip = '';


function getUserIpAddr()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		//ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		//ip pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function get_Safe_value($con, $str)
{
	if ($str != '') {
		return mysqli_real_escape_string($con, $str);
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<!-- Head Tag -->
<?php include("mainincludes/csslinks.php"); ?>

<style>
	.login-form input {
		margin-bottom: 5px !important;

	}

	.login-form p {
		color: red;
		text-align: left;
		margin-bottom: 30px;
	}

	.error {
		color: #F00;
		background-color: #FFF;
		text-align: left;
	}
</style>

<body id="home-version-1" class="home-version-1" data-style="default">

	<div class="site-content">

		<!-- Header -->
		<?php include("mainincludes/header.php"); ?>
		
		<!-- Breadcrumb -->

		<section class="breadcrumb-area" style="padding: 130px 0 10px;">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="index.php">Home |</a> Login</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- usercheck -->
		<?php
		if (!isset($_SESSION['registered']) || $_SESSION['registered'] == '') {
			$_SESSION['registered'] = 0;
		}
		if (!isset($_SESSION['customerloginerrorflag']) || $_SESSION['customerloginerrorflag'] == '') {
			$_SESSION['customerloginerrorflag'] = 0;
		}
		?>
		<?php
		if ($_SESSION['registered'] == 1) { ?>
			<div style="margin-bottom:0px; text-align:center; font-size: large; " id="success-alert" class="alert alert-success"><b> Success !</b> You are now registered .</div>
		<?php $_SESSION['registered'] = 0;
		}
		if ($_SESSION['customerloginerrorflag'] == 1) { ?>
			<div style="margin-bottom:0px; text-align:center; font-size: large; " id="danger-alert" class="alert alert-danger"><b> Incorrect credentials !</b> Please try again .</div>
		<?php $_SESSION['customerloginerrorflag'] = 0; }
		?>

		<section class="contact-area">
			<div class="container-fluid custom-container">
				<div class="section-heading pb-30">
					<h3>Login <span>Account</span></h3>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm-9 col-md-8 col-lg-6 col-xl-4">
						<div class="contact-form login-form">
							<form method="post" class="loginform" action="functions/authenticatecustomer.php">

								<input type="hidden" name="ipaddr" value="<?= $ip ?>">

								<div class="row">
									<div class="col-xl-12">
										<input type="email" placeholder="Email*" name="email" id="email">
										<p class="Err"></p>
									</div>
									<div class="col-xl-12">
										<input type="password" placeholder="Password*" name="pass" id="pass">
										<p class="Err"></p>
									</div>
									<div class="col-xl-12">
										<input type="submit" name="btnlogin" id="btnlogin" value="LOG IN">
										<p></p>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Create Account Area -->

		<section class="login-now">
			<div class="container-fluid custom-container">
				<div class="col-12">
					<span>Don't have account</span>
					<a href="create_account.php" class="btn-two">Create Account</a>
				</div>
			</div>
		</section>

		<!-- Subscribe Area -->
		<!-- <?php include("mainincludes/subscribe.php"); ?> -->

		<!-- Footer -->
		<?php include("mainincludes/footer.php"); ?>

		<!-- Back To Top -->
		<?php include("mainincludes/backtotop.php"); ?>

	</div>

	<!-- Dependency Scripts -->
	<script src="dependencies/jquery/jquery.min.js"></script>
	<script src="dependencies/popper.js/popper.min.js"></script>
	<script src="dependencies/bootstrap/js/bootstrap.min.js"></script>
	<script src="dependencies/owl.carousel/js/owl.carousel.min.js"></script>
	<script src="dependencies/wow/js/wow.min.js"></script>
	<script src="dependencies/isotope-layout/js/isotope.pkgd.min.js"></script>
	<script src="dependencies/imagesloaded/js/imagesloaded.pkgd.min.js"></script>
	<script src="dependencies/jquery.countdown/js/jquery.countdown.min.js"></script>
	<script src="dependencies/gmap3/js/gmap3.min.js"></script>
	<script src="dependencies/venobox/js/venobox.min.js"></script>
	<script src="dependencies/slick-carousel/js/slick.js"></script>
	<script src="dependencies/headroom/js/headroom.js"></script>
	<script src="dependencies/jquery-ui/js/jquery-ui.min.js"></script>
	<script src="admin/plugins/validation/jquery.validate.min.js"></script>

	<script>
		$("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
			$("#success-alert").slideUp(500);
		});

		$("#danger-alert").fadeTo(2000, 500).slideUp(500, function() {
			$("#danger-alert").slideUp(500);
		});

		$(document).ready(function() {
			//form validate
			$('#btnlogin').click(function() {
				jQuery(".loginform").validate({
					// in 'rules' user have to specify all the constraints for respective fields
					rules: {

						email: {
							required: true,
							minlength: 5
						},
						pass: {
							required: true,
							minlength: 5
						}

					},
					messages: {

						email: {
							required: "Please enter an email id",
							minlength: "Your email must be consist of at least 5 characters"
						},
						pass: {
							required: "Please enter a password",
							minlength: "Your password must be consist of at least 5 characters"
						}
					},
					highlight: function(element) {
						$('.Err').last().addClass('error')
					},
					unhighlight: function(element) {
						$('.Err').removeClass('error')
					}
				});
			})
		})
	</script>



	<!-- Site Scripts -->
	<script src="assets/js/app.js"></script>
</body>

</html>