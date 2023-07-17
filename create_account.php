<?php
require("config/dbconnect.php");


?>

<!DOCTYPE html>
<html lang="en">

<!-- Head Tag -->
<?php include("mainincludes/csslinks.php"); ?>

<style>
	.error {
		color: #F00;
		background-color: #FFF;
		text-align: left;
	}

	.contact-form input {
		margin-bottom: 5px !important;
	}

	.contact-form p {
		text-align: left;
		margin-bottom: 30px;
		color: red;
	}

	.customgender {
		width: 100%;
		height: 56px;
		background: #f2f1f1;
		border: none;
		padding-left: 20px;

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
							<p><a href="index.php">Home |</a> Create Account</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Create Account Area -->

		<section class="contact-area" style="padding-bottom:50px ;">
			<div class="container-fluid custom-container">
				<div class="section-heading pb-30">
					<h3>Create <span>Account</span></h3>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm-9 col-md-8 col-lg-6 col-xl-4">
						<div class="contact-form login-form">
							<form class="signupform" method="POST" action="functions/authenticatecustomer.php">
								<div class="row">
									<div class="col-xl-12">
										<input type="text" placeholder="First Name*" name="fname" id="fname">
										<div class="mydiv">
											<p class="Err"></p>
										</div>

									</div>
									<div class="col-xl-12">
										<input type="text" placeholder="Last Name*" name="lname" id="lname">
										<p class="Err"></p>
									</div>
									<div class="col-xl-12">
										<input type="date" name="dob" id="dob">
										<p class="Err"></p>
									</div>

									<div class="col-xl-12">
										<select class="customgender" placeholder="gender" name="gender" id="gender">
											<option value="" selected disabled>Gender...</option>
											<option value="M">Male</option>
											<option value="F">Female</option>
										</select>
										<p class="Err"></p>
									</div>

									<div class="col-xl-12">
										<input type="text" class="mobile"  placeholder="Mobile No" name="mobile" id="mobile">
										<p class="Err"></p>
									</div>
									<div class="col-xl-12">
										<input type="email" placeholder="Email*" name="email" id="email">
										<p class="Err"></p>
									</div>
									<div class="col-xl-12">
										<input type="text" placeholder="Username*" name="uname" id="uname">
										<p class="Err"></p>
									</div>
									<div class="col-xl-12">
										<input type="password" placeholder="Password*" name="pass" id="pass">
										<p class="Err"></p>
									</div>
									<div class="col-xl-12">
										<input type="password" placeholder="Confirm Password*" name="confPass" id="confPass">
										<p class="Err"></p>
									</div>
									<div class="col-xl-12">
										<input type="submit" name="btncreate" id="btncreate" value="Create">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Login Area -->

		<section class="login-now">
			<div class="container-fluid custom-container">
				<div class="col-12">
					<span>Already have account</span>
					<a href="login.php" class="btn-two">Login now</a>
				</div>
			</div>
		</section>

		<!-- Subscribe Area -->
		<?php // include("mainincludes/subscribe.php"); 
		?>

		<!-- Footer -->
		<?php include("mainincludes/footer.php"); ?>

		<!-- Back To top -->
		<?php include("mainincludes/backtotop.php"); ?>

	</div>

	<!-- Dependency Scripts -->
	<script src="dependencies/jquery/jquery.min.js"></script>
	<script src="dependencies/popper.js/popper.min.js"></script>
	<script src="dependencies/bootstrap/js/bootstrap.min.js"></script>
	<script src="dependencies/owl.carousel/js/owl.carousel.min.js"></script>
	<script src="dependencies/wow/js/wow.min.js"></script>
	<script src="dependencies/imagesloaded/js/imagesloaded.pkgd.min.js"></script>
	<script src="dependencies/slick-carousel/js/slick.js"></script>
	<script src="dependencies/jquery-ui/js/jquery-ui.min.js"></script>
	<script src="admin/plugins/validation/jquery.validate.min.js"></script>

	<script>
		$(document).ready(function() {

			//mobile check
			$('#mobile').keyup(function() {
				var regExp = /^\d+$/;
				var getnumber = $('#mobile').val();
				if (!regExp.test(getnumber)) {
					return $(this).val($.trim($(this).val()).slice(0, -1));
				}
			})

			//form validate
			$('#btncreate').click(function() {
				jQuery(".signupform").validate({
					// in 'rules' user have to specify all the constraints for respective fields
					rules: {
						fname: "required",
						lname: "required",
						uname: {
							required: true,
							minlength: 5
						},
						pass: {
							required: true,
							minlength: 5
						},
						confPass: {
							required: true,
							minlength: 5,
							equalTo: '#pass'
						},
						email: {
							required: true,
							email: true
						},
						gender: 'required',
						mobile: {
							maxlength: 10
						},
					},
					messages: {
						fname: "Please enter your Firstname",
						lname: "Please enter your Lastname",
						uname: {
							required: "Please enter a Username",
							minlength: "Your username must consist of at least 5 characters"
						},
						email: 'Please enter your Email',
						pass: {
							required: "Please enter a password",
							minlength: "Your password must be consist of at least 5 characters"
						},
						confPass: {
							required: "Please enter a password",
							minlength: "Your password must be consist of at least 5 characters",
							equalTo: "Please enter the same password as above"
						},
						gender: 'please select a gender',
						mobile: {
							maxlength: 'Only 10 digits allowed'
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